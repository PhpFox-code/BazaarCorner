<?php


defined('PHPFOX') or exit('NO DICE!');


class AdvancedMarketplace_Service_AdvancedMarketplace extends Phpfox_Service
{
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('advancedmarketplace');
	}
	

	public function getListing($iId)
	{
		(($sPlugin = Phpfox_Plugin::get('advancedmarketplace.Service_AdvancedMarketplace_getlisting')) ? eval($sPlugin) : false);

		if (Phpfox::isModule('like'))
		{
			$this->database()->select('lik.like_id AS is_liked, ')->leftJoin(Phpfox::getT('like'), 'lik', 'lik.type_id = \'advancedmarketplace\' AND lik.item_id = l.listing_id AND lik.user_id = ' . Phpfox::getUserId());
		}

		if (Phpfox::isModule('track'))
		{
			$this->database()->select("advancedmarketplace_track.item_id AS is_viewed, ")->leftJoin(Phpfox::getT('advancedmarketplace_track'), 'advancedmarketplace_track', 'advancedmarketplace_track.item_id = l.listing_id AND advancedmarketplace_track.user_id = ' . Phpfox::getUserBy('user_id'));
		}

		$this->database()->select('f.friend_id AS is_friend, ')->leftJoin(Phpfox::getT('friend'), 'f', "f.user_id = l.user_id AND f.friend_user_id = " . Phpfox::getUserId());

		$aListing = $this->database()->select('mt.short_description, mt.short_description_parsed, l.*, ml.invite_id, ml.visited_id, uf.total_score, uf.total_rating, ua.activity_points, ' . (Phpfox::getParam('core.allow_html') ? 'mt.description_parsed' : 'mt.description') . ' AS description, ' . Phpfox::getUserField())
		->from($this->_sTable, 'l')
		->join(Phpfox::getT('advancedmarketplace_text'), 'mt', 'mt.listing_id = l.listing_id')
		->join(Phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
		->join(Phpfox::getT('user_field'), 'uf', 'uf.user_id = l.user_id')
		->join(Phpfox::getT('user_activity'), 'ua', 'ua.user_id = l.user_id')
		->leftJoin(Phpfox::getT('advancedmarketplace_invite'), 'ml', 'ml.listing_id = l.listing_id AND ml.invited_user_id = ' . Phpfox::getUserId())
		->where('l.listing_id = ' . (int) $iId)
		->execute('getSlaveRow');

		if (!isset($aListing['listing_id']))
		{
			return false;
		}
		if (!Phpfox::isModule('like'))
		{
			$aListing['is_liked'] = false;
		}
		if ($aListing['view_id'] == '1')
		{
			if ($aListing['user_id'] == Phpfox::getUserId() || Phpfox::getUserParam('advancedmarketplace.can_approve_listings'))
			{

			}
			else
			{
				return false;
			}
		}
		if (!empty($aListing['location']))
		{
			$aListing['map_location'] = $aListing['location'];
			if (!empty($aListing['address']))
			{
				$aListing['map_location'] .= ',' . $aListing['address'];
			}
			if (!empty($aListing['city']))
			{
				$aListing['map_location'] .= ',' . $aListing['city'];
			}
			if (!empty($aListing['postal_code']))
			{
				$aListing['map_location'] .= ',' . $aListing['postal_code'];
			}	
			if (!empty($aListing['country_child_id']))
			{
				$aListing['map_location'] .= ',' . Phpfox::getService('core.country')->getChild($aListing['country_child_id']);
			}			
			if (!empty($aListing['country_iso']))
			{
				$aListing['map_location'] .= ',' . Phpfox::getService('core.country')->getCountry($aListing['country_iso']);
			}			
			
			$aListing['map_location'] = urlencode($aListing['map_location']);
		}
		$aListing['categories'] = Phpfox::getService('advancedmarketplace.category')->getCategoriesById($aListing['listing_id']);
		$aListing['bookmark_url'] = Phpfox::getLib('url')->permalink('advancedmarketplace', $aListing['listing_id'], $aListing['title']);
		$aListing['category'] = Phpfox::getService('advancedmarketplace.category')->getCategoryId($aListing['listing_id']);
		
		return $aListing;
	}

    public function getById($iId)
	{
		$aListing = $this->database()->select('l.*, description, short_description')
            ->from($this->_sTable, 'l')
            ->join(Phpfox::getT('advancedmarketplace_text'), 'mt', 'mt.listing_id = l.listing_id')
            ->where('l.listing_id = ' . (int) $iId)
            ->execute('getSlaveRow');
		return $aListing;		
	}
    
	public function getForEdit($iId, $bForce = false)
	{
		(($sPlugin = Phpfox_Plugin::get('advancedmarketplace.Service_AdvancedMarketplace_getforedit')) ? eval($sPlugin) : false);

		$aListing = $this->database()->select('l.*, description, short_description')
		->from($this->_sTable, 'l')
		->join(Phpfox::getT('advancedmarketplace_text'), 'mt', 'mt.listing_id = l.listing_id')
		->where('l.listing_id = ' . (int) $iId)
		->execute('getSlaveRow');
		//(Phpfox::getUserId() == $aListing['user_id'] ? Phpfox::getUserParam('advancedmarketplace.can_edit_own_listing', true) : Phpfox::getUserParam('advancedmarketplace.can_edit_other_listing', true));
		if ((($aListing['user_id'] == Phpfox::getUserId() && Phpfox::getUserParam('advancedmarketplace.can_edit_own_listing')) || Phpfox::getUserParam('advancedmarketplace.can_edit_other_listing')) || ($bForce === true))
		{
			$aListing['categories'] = Phpfox::getService('advancedmarketplace.category')->getCategoryIds($aListing['listing_id']);
			$aListing['category'] = Phpfox::getService('advancedmarketplace.category')->getCategoryId($aListing['listing_id']);

			return $aListing;
		}

		return false;
	}

	public function getInvoice($iId)
	{
		$aInvoice = $this->database()->select('mi.*, m.title, m.user_id AS advancedmarketplace_user_id, ' . Phpfox::getUserField())
		->from(Phpfox::getT('advancedmarketplace_invoice'), 'mi')
		->join(Phpfox::getT('advancedmarketplace'), 'm', 'm.listing_id = mi.listing_id')
		->join(Phpfox::getT('user'), 'u', 'u.user_id = mi.user_id')
		->where('mi.invoice_id = ' . (int) $iId)
		->execute('getRow');

		return (isset($aInvoice['invoice_id']) ? $aInvoice : false);
	}

	public function getInvoices($aCond, $bGroupUser = false)
	{
		if ($bGroupUser)
		{
			$this->database()->group('mi.user_id');
		}

		$iCnt = $this->database()->select('COUNT(*)')
		->from(Phpfox::getT('advancedmarketplace_invoice'), 'mi')
		->where($aCond)
		->execute('getSlaveField');

		if ($bGroupUser)
		{
			$this->database()->group('mi.user_id');
		}

		$aRows = $this->database()->select('mi.*, ' . Phpfox::getUserField())
		->from(Phpfox::getT('advancedmarketplace_invoice'), 'mi')
		->join(Phpfox::getT('user'), 'u', 'u.user_id = mi.user_id')
		->where($aCond)
		->execute('getSlaveRows');

		foreach ($aRows as $iKey => $aRow)
		{
			switch ($aRow['status'])
			{
				case 'completed':
					$aRows[$iKey]['status_phrase'] = Phpfox::getPhrase('advancedmarketplace.paid');
					break;
				case 'cancel':
					$aRows[$iKey]['status_phrase'] = Phpfox::getPhrase('advancedmarketplace.cancelled');
					break;
				case 'pending':
					$aRows[$iKey]['status_phrase'] = Phpfox::getPhrase('advancedmarketplace.pending_payment');
					break;
				default:
					$aRows[$iKey]['status_phrase'] = Phpfox::getPhrase('advancedmarketplace.pending_payment');
					break;
			}
		}

		return array($iCnt, $aRows);
	}

	public function getForProfileBlock($iUserId, $iLimit = 5)
	{
		(($sPlugin = Phpfox_Plugin::get('advancedmarketplace.Service_AdvancedMarketplace_getforprofileblock')) ? eval($sPlugin) : false);

		return $this->database()->select('m.*')
		->from($this->_sTable, 'm')
		->where('m.view_id = 0 AND m.group_id = 0 AND m.user_id = ' . (int) $iUserId)
		->limit($iLimit)
		->order('m.time_stamp DESC')
		->execute('getSlaveRows');
	}

	public function getImages($iId, $iLimit = null)
	{
		return $this->database()->select('image_id, image_path, server_id')
		->from(Phpfox::getT('advancedmarketplace_image'))
		->where('listing_id = ' . (int) $iId)
		->order('ordering ASC')
		->limit($iLimit)
		->execute('getSlaveRows');
	}

	public function getSponsorListings()
	{
		$sCacheId = $this->cache()->set('advancedmarketplace_sponsored');
		if (!($aListing = $this->cache()->get($sCacheId)))
		{
			$aListing = $this->database()->select('m.*,s.sponsor_id, m.title, m.currency_id, m.price, m.time_stamp, m.image_path, m.server_id, '.phpfox::getUserField())
			->from($this->_sTable, 'm')
			->join(Phpfox::getT('ad_sponsor'), 's', 's.item_id = m.listing_id')
			->join(phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
			->where('m.view_id = 0 AND m.privacy = 0 AND m.group_id = 0 AND is_sponsor = 1 AND s.module_id = "advancedmarketplace" and m.post_status != 2')
			->order(" rand() ")
			->execute('getSlaveRows');

			$this->cache()->save($sCacheId, $aListing);
		}
		if (!empty($aListing) && is_array($aListing)) {
            foreach ($aListing as $iKey => $aItem) {
                $aListing[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aItem['listing_id'], $aItem['title']);
                
            }
        }

		if ($aListing === true || (is_array($aListing) && !count($aListing)))
		{
			return array();
		}

		shuffle($aListing);

		$aOut = array();
		for($iLoop = 0; $iLoop < Phpfox::getParam('advancedmarketplace.how_many_sponsored_listings'); $iLoop++)
		{
			if (empty($aListing))
			{
				break;
			}
			$aOut[] = array_pop($aListing);
		}

		return $aOut;
	}

	public function getInvites($iListing, $iType, $iPage = 0, $iPageSize = 8)
	{
		$aInvites = array();
		$iCnt = $this->database()->select('COUNT(*)')
		->from(Phpfox::getT('advancedmarketplace_invite'))
		->where('listing_id = ' . (int) $iListing . ' AND visited_id = ' . (int) $iType)
		->execute('getSlaveField');

		if ($iCnt)
		{
			$aInvites = $this->database()->select('ei.*, ' . Phpfox::getUserField())
			->from(Phpfox::getT('advancedmarketplace_invite'), 'ei')
			->leftJoin(Phpfox::getT('user'), 'u', 'u.user_id = ei.invited_user_id')
			->where('ei.listing_id = ' . (int) $iListing . ' AND ei.visited_id = ' . (int) $iType)
			->limit($iPage, $iPageSize, $iCnt)
			->order('ei.invite_id DESC')
			->execute('getSlaveRows');
		}

		return array($iCnt, $aInvites);
	}

	public function getUserListings($iListingId, $iUserId)
	{
		(($sPlugin = Phpfox_Plugin::get('advancedmarketplace.Service_AdvancedMarketplace_getuserlistings_count')) ? eval($sPlugin) : false);

		$iCnt = $this->database()->select('COUNT(*)')
		->from($this->_sTable, 'v')
		->join(Phpfox::getT('user'), 'u', 'u.user_id = v.user_id')
		->where('v.listing_id != ' . (int) $iListingId . ' AND v.view_id = 0 AND v.user_id = ' . (int) $iUserId)
		->execute('getSlaveField');

		(($sPlugin = Phpfox_Plugin::get('advancedmarketplace.Service_AdvancedMarketplace_getuserlistings_query')) ? eval($sPlugin) : false);

		$aRows = $this->database()->select('v.*, ' . Phpfox::getUserField())
		->from($this->_sTable, 'v')
		->join(Phpfox::getT('user'), 'u', 'u.user_id = v.user_id')
		->where('v.listing_id != ' . (int) $iListingId . ' AND v.view_id = 0 AND v.user_id = ' . (int) $iUserId)
		->limit(Phpfox::getParam('advancedmarketplace.total_listing_more_from'))
		->order('v.time_stamp DESC')
		->execute('getSlaveRows');

		return array($iCnt, $aRows);
	}

	public function getPendingTotal()
	{
		return $this->database()->select('COUNT(*)')
		->from($this->_sTable)
		->where('view_id = 1')
		->execute('getSlaveField');
	}

	public function isAlreadyInvited($iItemId, $aFriends)
	{
		
		if ((int) $iItemId === 0)
		{
			return false;
		}

		if (is_array($aFriends))
		{
			if (!count($aFriends))
			{
				return false;
			}

			$sIds = '';
			foreach ($aFriends as $aFriend)
			{
				if (!isset($aFriend['user_id']))
				{
					continue;
				}

				$sIds[] = $aFriend['user_id'];
			}

			$aInvites = $this->database()->select('invite_id, visited_id, invited_user_id')
			->from(Phpfox::getT('advancedmarketplace_invite'))
			->where('listing_id = ' . (int) $iItemId . ' AND invited_user_id IN(' . implode(', ', $sIds) . ')')
			->execute('getSlaveRows');

			$aCache = array();
			foreach ($aInvites as $aInvite)
			{
				$aCache[$aInvite['invited_user_id']] = ($aInvite['visited_id'] ? 'Visted' : 'Invited');
			}
		
			if (count($aCache))
			{
				return $aCache;
			}
		}

		return false;
	}

	public function getFeatured()
	{
		$sCacheId = $this->cache()->set('advancedmarketplace_featured');

		if (!($aRows = $this->cache()->get($sCacheId)))
		{
			$aRows = $this->database()->select('m.*')
			->from(Phpfox::getT('advancedmarketplace'), 'm')
			->where('m.view_id = 0 AND m.privacy = 0 AND m.is_featured = 1')
			->execute('getSlaveRows');

			foreach ($aRows as $iKey => $aRow)
			{
				$aRows[$iKey]['images'] = $this->getImages($aRow['listing_id'], 5);
			}

			$this->cache()->save($sCacheId, $aRows);
		}

		if (!is_array($aRows))
		{
			return array();
		}

		shuffle($aRows);

		$aReturn = array();
		$iCnt = 0;
		foreach ($aRows as $aRow)
		{
			$iCnt++;

			if ($iCnt > 5)
			{
				break;
			}

			$aReturn[] = $aRow;
		}

		return $aReturn;
	}

	public function getTotalInvites()
	{
		static $iCnt = null;

		if ($iCnt !== null)
		{
			return $iCnt;
		}

		$iCnt = (int) $this->database()->select('COUNT(m.listing_id)')
		->from(Phpfox::getT('advancedmarketplace_invite'), 'mi')
		->join(Phpfox::getT('advancedmarketplace'), 'm', 'm.listing_id = mi.listing_id AND m.view_id = 0')
		->where('mi.visited_id = 0 AND mi.invited_user_id = ' . Phpfox::getUserId())
		->execute('getSlaveField');

		return $iCnt;
	}

	public function getUserInvites($iLimit = 5)
	{//jh: anchor
		$iCnt = $this->getTotalInvites();

		$aRows = $this->database()->select('m.*, '.phpfox::getUserField())
		->from(Phpfox::getT('advancedmarketplace_invite'), 'mi')
		->join(Phpfox::getT('advancedmarketplace'), 'm', 'm.listing_id = mi.listing_id AND m.view_id = 0')
		->join(phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
		->where('mi.visited_id = 0 AND mi.invited_user_id = ' . Phpfox::getUserId())
		->limit($iLimit)
		->execute('getSlaveRows');
		
// $iCnt = (int) $this->database()->select('COUNT(m.listing_id)')
// ->from(Phpfox::getT('advancedmarketplace_invite'), 'mi')
// ->join(Phpfox::getT('advancedmarketplace'), 'm', 'm.listing_id = mi.listing_id AND m.view_id = 0')
// ->where('mi.visited_id = 0 AND mi.invited_user_id = ' . Phpfox::getUserId())
// ->execute('getSlaveField');
		
		if (count($iCnt) > 0) {
            foreach ($aRows as $iKey => $aListing) {
                $aRows[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
            }
        }
		// echo PHPFOX::getLib("database")->sSqlQuery;
		return array($iCnt, $aRows);
	}

	public function proccessImageName($imgName, $strAppend = '') {
        return sprintf($imgName, $strAppend);
	}

	public function getTagCloud()
	{
		$aRows = phpfox::getLib('database')->select('t.category_id, t.tag_text AS tag, t.tag_url, COUNT(t.item_id) AS total')
				->from(phpfox::getT('tag'), 't')
				->join(phpfox::getT('advancedmarketplace'), 'am', 'am.listing_id = t.item_id')
				->where('t.category_id = "advancedmarketplace" and am.view_id = 0 and am.post_status != 2')
				->group('tag_text, tag_url')
				->having('total > ' . (int) Phpfox::getParam('tag.tag_min_display'))
				->order('total DESC')
				->limit(Phpfox::getParam('tag.tag_trend_total_display'))
				->execute('getSlaveRows');
		foreach ($aRows as $aRow)
		{
			$aTempTags[] = array
			(
	                'value' => $aRow['total'],
	                'key' => $aRow['tag'],
	                'url' => $aRow['tag_url'],
	            	'link' => Phpfox::getLib('url')->makeUrl('advancedmarketplace.search.', array('tag', $aRow['tag_url']))
			);
		}
		if (empty($aTempTags))
		{
			return array();
		}
		return $aTempTags;
	}

    public function getTagCloudRandom($iLimit = 15)
	{
		$aRows = phpfox::getLib('database')->select('t.category_id, t.tag_text AS tag, t.tag_url, COUNT(t.item_id) AS total')
				->from(phpfox::getT('tag'), 't')
				->join(phpfox::getT('advancedmarketplace'), 'am', 'am.listing_id = t.item_id')
				->where('t.category_id = "advancedmarketplace" and am.view_id = 0 and am.post_status != 2')
				->group('tag_text, tag_url')
				->having('total > ' . (int) Phpfox::getParam('tag.tag_min_display'))
				->order('rand()')
				->limit($iLimit)
				->execute('getSlaveRows');
		foreach ($aRows as $aRow)
		{
			$aTempTags[] = array
			(
	                'value' => $aRow['total'],
	                'key' => $aRow['tag'],
	                'url' => $aRow['tag_url'],
	            	'link' => Phpfox::getLib('url')->makeUrl('advancedmarketplace.search.', array('tag', $aRow['tag_url']))
			);
		}
		if (empty($aTempTags))
		{
			return array();
		}
		return $aTempTags;
	}
    
	public function getListings($aConds = array(), $sSort = 'l.time_stamp desc', $iPage = 0, $iLimit = 0)
	{
		$sCond = '';
		if(!empty($aConds))
		{
			foreach($aConds as $c)
			{
				if(empty($sCond))
				{
					$sCond = $c;
				}
				else
				{
					$sCond .= ' AND '.$c;
				}
			}
		}
		$iQuery = phpfox::getLib('database')->select('count(*)')
				->from(phpfox::getT('advancedmarketplace'), 'l')
				->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				->where($sCond);
		if(isset($_POST['category_id']))
		{
			$iQuery->innerjoin(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id');
			//$oQuery->innerjoin(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id');
		}
				//->group('l.listing_id')
		$iCnt = $iQuery->execute('getField');

		$oQuery = $this->database()->select('l.*, ' . Phpfox::getUserField())
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				->join(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id')
				->leftjoin(phpfox::getT('advancedmarketplace_today_listing'), 'td', 'td.listing_id = l.listing_id')
                ->where($sCond)
				->group('l.listing_id');

		$oQuery->order('l.time_stamp desc');
		if($iLimit > 0) {
			$oQuery->limit($iPage, $iLimit, $iCnt);
		}

        $aListings = $oQuery->execute('getRows');

		if(!empty($aListings))
		{

			foreach($aListings as $iKey => $aListing)
			{

				/*
				$sCategoryIds = phpfox::getService('advancedmarketplace.category')->getCategoryIds($aListing['listing_id']);
								$aCategoryIds = explode(',', $sCategoryIds);
								$iChildCat = $aCategoryIds[0];
								foreach($aCategoryIds as $aCat)
								{
									$iCat = phpfox::getService('advancedmarketplace.category')->getChildIds($aCat);
									if(empty($iCat))
									{
										$iChildCat = $aCat;
									}
								}
								$aCat = phpfox::getService('advancedmarketplace.category')->getForEdit($iChildCat);
								$aListings[$iKey]['category'] = $aCat['name'];*/

				$aListings[$iKey]['categories'] = Phpfox::getService('advancedmarketplace.category')->getCategoriesById($aListing['listing_id']);
				$aListings[$iKey]['time_stamp'] = phpfox::getTime(Phpfox::getParam('advancedmarketplace.advancedmarketplace_view_time_stamp'), $aListing['time_stamp']);
			}

		}

		return array($iCnt, $aListings);

	}

	public function getTodayListings($aConds = array(), $sSort = 'listing_id desc', $iPage = 0, $iLimit = 0)
	{
		$sCond = '';
		if(!empty($aConds))
		{
			foreach($aConds as $c)
			{
				if(empty($sCond))
				{
					$sCond = $c;
				}
				else
				{
					$sCond .= ' AND '.$c;
				}
			}
		}
		$iQuery = phpfox::getLib('database')->select('count(*)')
				->from(phpfox::getT('advancedmarketplace'), 'l')
				->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				->join(phpfox::getT('advancedmarketplace_today_listing'), 'td', 'td.listing_id = l.listing_id')
				->where($sCond)
				->group('l.listing_id');
		if(isset($_POST['category_id']))
		{
			$iQuery->innerjoin(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id');
			//$iQuery->innerjoin(phpfox::getT('advancedmarketplace_today_listing'), 'td', 'td.listing_id = l.listing_id');
			//$oQuery->innerjoin(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id');
		}
		$iCnt = $iQuery->execute('getField');

		$oQuery = $this->database()->select('l.*, ' . Phpfox::getUserField())
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				->join(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id')
				->join(phpfox::getT('advancedmarketplace_today_listing'), 'td', 'td.listing_id = l.listing_id')
                ->where($sCond)
				->group('l.listing_id')
                ->order($sSort);

		if($iLimit > 0) {
			$oQuery->limit($iPage, $iLimit, $iCnt);
		}

        $aListings = $oQuery->execute('getRows');

		if(!empty($aListings))
		{

			foreach($aListings as $iKey => $aListing)
			{
				$aListings[$iKey]['categories'] = Phpfox::getService('advancedmarketplace.category')->getCategoriesById($aListing['listing_id']);
				$aListings[$iKey]['time_stamp'] = phpfox::getTime(Phpfox::getParam('advancedmarketplace.advancedmarketplace_view_time_stamp'), $aListing['time_stamp']);
			}

		}

		return array($iCnt, $aListings);

	}
	public function getTodayListing($iListingId) {
		$aRows = $this->database()->select('today_listing_id, listing_id, (time_stamp * 1000) as `time_stamp`')
			->from(Phpfox::getT('advancedmarketplace_today_listing'))
			->where(sprintf("listing_id=%d AND time_stamp > (86400 * 31)", $iListingId))
			->execute('getSlaveRows');
		// var_dump($aRows);
		// exit;
		return ($aRows);
	}


	public function getListingStatistics()
	{
		$aListingStatistics = array();
		$iTotalListings = phpfox::getLib('database')->select('count(*)')
			->from(phpfox::getT('advancedmarketplace'))
			->execute('getSlaveField');

		$iApprovedListings = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace'))
			 ->where('(post_status = 1 OR post_status = 2) and view_id = 0')
			 ->execute('getSlaveField');

		$iDraftListings = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace'))
			 ->where('post_status = 2')
			 ->execute('getSlaveField');

		$iFeaturedListings = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace'))
			 ->where('is_featured = 1')
			 ->execute('getSlaveField');

		$iSponsoredListings = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace'))
			 ->where('is_sponsor = 1')
			 ->execute('getSlaveField');

		$iAvailableListings = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace'))
			 ->where('post_status != 2 and (view_id = 0 OR view_id = 2) ')
			 ->execute('getSlaveField');

		$iClosedListings = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace'))
			 ->where('view_id = 2')
			 ->execute('getSlaveField');

		$iTotalReviews = phpfox::getLib('database')->select('count(*)')
			 ->from(phpfox::getT('advancedmarketplace_rate'))
			 ->execute('getSlaveField');

		$iTotalReviewListings = phpfox::getLib('database')->select('count(DISTINCT listing_id)')
			 ->from(phpfox::getT('advancedmarketplace_rate'))
			 ->execute('getSlaveField');

		$aListingStatistics['total_listings'] = $iTotalListings;
		$aListingStatistics['approved_listings'] = $iApprovedListings;
		$aListingStatistics['draft_listings'] = $iDraftListings;
		$aListingStatistics['featured_listings'] = $iFeaturedListings;
		$aListingStatistics['sponsored_listings'] = $iSponsoredListings;
		$aListingStatistics['available_listings'] = $iAvailableListings;
		$aListingStatistics['closed_listings'] = $iClosedListings;
		$aListingStatistics['total_reviews'] = $iTotalReviews;
		$aListingStatistics['total_reviewed_listings'] = $iTotalReviewListings;
		return $aListingStatistics;
	}

	public function getReviewsListing($iId, $iPage, $iPageSize)
	{

		$aReviews = phpfox::getLib('database')->select('r.*,'.phpfox::getUserField())
					->from(phpfox::getT('advancedmarketplace_rate'), 'r')
					->join(Phpfox::getT('user'), 'u', 'u.user_id = r.user_id')
					->where('listing_id = '.$iId.' and l.post_status != 2 and l.view_id = 0')
					->limit($iPage, $iPageSize, 2)
					->execute('getSlaveRows');
		return $aReviews;
	}

	public function getCountReviewsListing($iId)
	{
		return phpfox::getLib('database')->select('count(*)')
					->from(phpfox::getT('advancedmarketplace_rate'))
					->where('listing_id = '.$iId)
					->execute('getSlaveField');
	}

	public function loadSubcatByParentID($iParentCatId) {
        return PHPFOX::getLib("database")
                        ->select("*")
                        ->from(PHPFOX::getT('advancedmarketplace_category'), "p")
                        ->where(sprintf("p.parent_id = %d", $iParentCatId))
                        ->execute("getSlaveRows")
        ;
    }

    public function getForHomepage($aConds = array(), $sSort = 'listing_id desc', $iPage = 0, $iLimit = 0, $bIsHaveSearchTag = 0) 
    {
		$iOffset = ($iPage - 1) * $iLimit;
        $oQuery = $this->database()->select('count(*)')
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->leftjoin(Phpfox::getT('advancedmarketplace_category_data'), 'mcd', 'mcd.listing_id = l.listing_id')
                ->where($aConds);                
        if ($bIsHaveSearchTag)
        {
            $oQuery->innerJoin(Phpfox::getT('tag'), 'tag', 'tag.item_id = l.listing_id AND tag.category_id = \'advancedmarketplace\'');	
        }
        $iCnt = $oQuery->execute('getField');
        
        $oQuery = $this->database()->select('DISTINCT l.title, l.listing_id, l.image_path, l.price, l.country_iso, l.is_sponsor, l.is_featured, l.time_stamp, l.post_status, l.currency_id, l.privacy, l.total_comment, l.total_like, l.privacy_comment, t.description, t.short_description, ' . Phpfox::getUserField())
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->join(Phpfox::getT('advancedmarketplace_text'), 't', 't.listing_id = l.listing_id')
                ->leftjoin(Phpfox::getT('advancedmarketplace_category_data'), 'mcd', 'mcd.listing_id = l.listing_id')
                ->join(Phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
                ->order($sSort)		
                ->where($aConds)
                ->limit($iOffset, $iLimit);        
        
        if ($bIsHaveSearchTag)
        {
            $oQuery->innerJoin(Phpfox::getT('tag'), 'tag', 'tag.item_id = l.listing_id AND tag.category_id = \'advancedmarketplace\'');	
        }
        $aListings = $oQuery->execute('getRows'); 
        
        if (!empty($aListings) && is_array($aListings))
        {
            /*
			foreach ($aListings as $iKey => $aListing)
            {
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
                $this->_convertFormatCurrency($aListings[$iKey]);
            }
			*/			
			foreach ($aListings as $i => $aListing)
			{
				$aListings[$i]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
                $this->_convertFormatCurrency($aListings[$i]);
				if ($aListings[$i]['image_path'])
				{
					$sImage = sprintf($aListings[$i]['image_path'], '_200');
					$aListings[$i]['image_path'] = Phpfox::getParam('core.url_pic') . "advancedmarketplace/" . $sImage;
					$aListings[$i]['image_dir'] = Phpfox::getParam('core.dir_pic') . "advancedmarketplace/" . $sImage;
				}
				else
				{					
					$aListings[$i]['image_path'] = Phpfox::getParam('core.path') . 'module/advancedmarketplace/static/image/default/noimage.png';
					$aListings[$i]['image_dir'] = PHPFOX_DIR . 'module/advancedmarketplace/static/image/default/noimage.png';
				}
				if (file_exists($aListings[$i]['image_dir'])) 
				{					
					$aSize = @getimagesize($aListings[$i]['image_dir']);
				}				
				$iW = isset($aSize[0]) ? $aSize[0] : 0;
				$iH = isset($aSize[1]) ? $aSize[1] : 0;
				if ($iW < 170) $iW = 170;				
				$aListings[$i]['image_width'] = $iW . 'px';
				if ($iW > 170)
				{
					$aListings[$i]['image_height'] = $iH * (170/$iW) . 'px';
				}
				else
				{
					$aListings[$i]['image_height'] =  $iH . 'px';
				}
				$aFeed = array(
					'no_share' => true,
					'enable_like' => false,	
					'comment_type_id' => 'advancedmarketplace',
					'privacy' => $aListing['privacy'],
					'comment_privacy' => $aListing['privacy_comment'],
					'like_type_id' => 'advancedmarketplace',
					'total_comment' => isset($aListing['total_comment']) ? $aListing['total_comment'] : 0,
					'total_like' => isset($aListing['total_like']) ? $aListing['total_like'] : 0,                
					'can_post_comment' => true,
					'feed_mini' => true,
					'feed_display' => 'view',
					'feed_is_liked' => isset($aListing['is_liked']) ? $aListing['is_liked'] : 0,
					'feed_is_friend' => isset($aListing['is_friend']) ? $aListing['is_friend'] : 0,
					'item_id' => $aListing['listing_id'],
					'user_id' => $aListing['user_id'],                
					'feed_link' => Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']),
					'feed_title' => $aListing['title'],
					'feed_total_like' => isset($aListing['total_like']) ? $aListing['total_like'] : 0,                
					'no_comment_pager' => true,                
					'comment_display' => 3, 
					'no_textarea' => true                
				); 
				$aListings[$i]['aFeed'] = $aFeed;
			}
		}
        return array($iCnt, $aListings);
	}
    
	public function frontend_getRecentListings($aConds = array(), $sSort = 'listing_id desc', $iPage = 0, $iLimit = 0, $isCountOnly = false) {
		$iOffset = ($iPage - 1) * $iLimit;
        $sCond = '';
        if (!empty($aConds)) {
            foreach ($aConds as $c) {
                if (empty($sCond)) {
                    $sCond = $c;
                } else {
                    $sCond .= ' AND ' . $c;
                }
            }
        }

        $iCnt = Phpfox::getLib('database')->select('count(*)')
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->where($sCond)
                ->execute('getField');        
        
        if ($isCountOnly) return $iCnt;
        
        $aListings = $this->database()->select('DISTINCT l.title, l.listing_id, l.image_path, l.price, l.country_iso, l.is_sponsor, l.is_featured, l.time_stamp, l.post_status, l.currency_id, l.privacy, l.total_comment, l.total_like, l.privacy_comment, t.description, t.short_description, ' . Phpfox::getUserField())
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->join(Phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
                ->join(Phpfox::getT('advancedmarketplace_text'), 't', 't.listing_id = l.listing_id')
                ->order($sSort)		
                ->where($sCond)
                ->limit($iOffset, $iLimit)
                ->execute('getRows');                       
        
        if (!empty($aListings) && is_array($aListings)) {
            foreach ($aListings as $iKey => $aListing) {
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
                $this->_convertFormatCurrency($aListings[$iKey]);
            }
        }
        return array($iCnt, $aListings);
	}

    public function frontend_getListings($aConds = array(), $sSort = 'listing_id desc', $iPage = 0, $iLimit = 0) {
        $sCond = '';
        if (!empty($aConds)) {
            foreach ($aConds as $c) {
                if (empty($sCond)) {
                    $sCond = $c;
                } else {
                    $sCond .= ' AND ' . $c;
                }
            }
        }

        $iCnt = phpfox::getLib('database')->select('count(*)')
                ->from(phpfox::getT('advancedmarketplace'), 'l')
                ->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
                ->join(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id')
                ->where($sCond)
                ->execute('getField');
		//var_dump(phpfox::getLib('database')->sSqlQuery);
		//var_dump($iCnt);
        $oQuery = $this->database()->select('DISTINCT l.title, l.listing_id, l.image_path, l.price, l.country_iso, l.is_sponsor, l.is_featured, currency_id, l.total_view, l.time_stamp, t.description, t.short_description, ' . Phpfox::getUserField())
                ->from(Phpfox::getT('advancedmarketplace'), 'l')
                ->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
                ->join(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id')
                ->join(phpfox::getT('advancedmarketplace_text'), 't', 't.listing_id = l.listing_id')
                ->order($sSort);
		// privacy

		$currentUserId = PHPFOX::getUserId();
		$prefix = PHPFOX::getT("");
		$stable_advancedmarketplace = "l";
		$stable_friend = PHPFOX::getT("friend");
		$stable_friend_list_data = PHPFOX::getT("friend_list_data");
		$stable_friend_list = PHPFOX::getT("friend_list");
		$stable_privacy = PHPFOX::getT("privacy");
		$sub_query = "SELECT $stable_friend_list_data.friend_user_id FROM $stable_friend_list INNER JOIN $stable_privacy ON $stable_privacy.friend_list_id = $stable_friend_list.list_id INNER JOIN ".$prefix."user ON ".$prefix."user.user_id = $stable_privacy.user_id INNER JOIN $stable_friend_list_data ON $stable_friend_list.list_id = $stable_friend_list_data.list_id WHERE $stable_privacy.module_id = \"musicsharing_album\" AND $stable_privacy.item_id = $stable_advancedmarketplace.listing_id";
		$sub_query_fof = "select f.user_id from $stable_friend as f inner Join (select ffxf.friend_user_id from $stable_friend as ffxf where ffxf.is_page=0 and ffxf.user_id = $currentUserId) as sf ON sf.friend_user_id = f.friend_user_id join ".$prefix."user as u ON u.user_id = f.friend_user_id";

		$oQuery->where('l.post_status != 2 and l.privacy = 0 and l.view_id = 0');

		/// privacy

        if (Phpfox::getParam('advancedmarketplace.total_listing_more_from') > 0) {
            $oQuery->limit(Phpfox::getParam('advancedmarketplace.total_listing_more_from'));
        }

        $aListings = $oQuery->execute('getRows');
       if (!empty($aListings) && is_array($aListings)) 
       {
            foreach ($aListings as $iKey => $aListing) 
        	{
        		$this->_convertFormatCurrency($aListings[$iKey]);
        	}
        }
        $this->_addCategoryUrl($aListings);

        return array($iCnt, $aListings);
    }

    public function frontend_getRecentViewListings($sLimit = 3)
    {
		$iCnt = phpfox::getLib("database")->select('count(*)')
				->from(PHPFOX::getT('advancedmarketplace'), 'l')
				->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				->join(PHPFOX::getT('advancedmarketplace_recent_view'), "rw", "l.listing_id = rw.listing_id")
				->where("rw.user_id = ".phpfox::getUserId()." and l.post_status != 2 and l.view_id = 0 and l.privacy = 0")
				->execute('getSlaveField');

		$oQuery = PHPFOX::getLib("database")
			->select("l.title, l.listing_id, l.image_path, l.price, l.country_iso, l.time_stamp, currency_id,".Phpfox::getUserField())
			->from(PHPFOX::getT('advancedmarketplace'), 'l')
			->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
			// ->join(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id')
			->join(PHPFOX::getT('advancedmarketplace_recent_view'), "rw", "l.listing_id = rw.listing_id")
			->where("rw.user_id = ".phpfox::getUserId()." and l.post_status != 2 and l.view_id = 0 and l.privacy = 0");

		$oQuery->order("rw.timestamp DESC");

		$oQuery->limit(phpfox::getParam('advancedmarketplace.total_listing_more_from'));

		$aListings = $oQuery->execute("getRows");

		if (!empty($aListings) && is_array($aListings)) {
            foreach ($aListings as $iKey => $aListing) {
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
				$this->_convertFormatCurrency($aListings[$iKey]);
            }
        }
		return array($iCnt, $aListings);
    }

    public function frontend_getTodayListings($iUserId = NULL, $sOrderBy = NULL, $sLimit = NULL) {
        if($iUserId === NULL) {
			$iUserId = PHPFOX::getUserId();
		}

		$oQuery = PHPFOX::getLib("database")
			->select('l.title, l.listing_id, l.image_path, l.price, l.country_iso, l.currency_id, '.phpfox::getUserField())
			->from(PHPFOX::getT("advancedmarketplace"), "l")
			->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
			// ->join(phpfox::getT('advancedmarketplace_category_data'), 'cd', 'cd.listing_id = l.listing_id')
			//->join(phpfox::getT('advancedmarketplace_text'), 't', 't.listing_id = l.listing_id')
			->join(PHPFOX::getT("advancedmarketplace_today_listing"), "tl", "l.listing_id = tl.listing_id")
			->where(sprintf("FROM_UNIXTIME(tl.time_stamp) = CURRENT_DATE").' and l.post_status != 2 and l.view_id = 0 and l.privacy = 0')
			->group('l.listing_id');

		if($sOrderBy !== NULL){
			$oQuery->order(" rand() " . $sOrderBy);
		} else {
			$oQuery->order(" rand() ");
		}

		if($sLimit !== NULL){
			$oQuery->limit($sLimit);
		}

		$aListings = $oQuery->execute("getRows");
		if(!empty($aListings))
		{
			
		}
		if (!empty($aListings) && is_array($aListings)) {
            foreach ($aListings as $iKey => $aListing) {
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
                $this->_convertFormatCurrency($aListings[$iKey]);
            }
        }

		return $aListings;
    }

	public function frontend_getListingReview($iListingId = NULL, $iLimit = NULL, $iPage = 0) {
        $oQueryCount = $this->database()->select('COUNT(*)')
                ->from(PHPFOX::getT("advancedmarketplace_rate"), "p")
                ->join(PHPFOX::getT("advancedmarketplace"), "l", "l.listing_id = p.listing_id")
				->join(PHPFOX::getT("user"), "u", "p.user_id = u.user_id");

        if ($iListingId !== NULL) {
            $oQueryCount->where(sprintf("l.listing_id = %d", $iListingId));
        }

        $iCount = $oQueryCount->execute('getSlaveField');

        $oQuery = PHPFOX::getLib("database")
                ->select("p.*, u.*")
                ->from(PHPFOX::getT("advancedmarketplace_rate"), "p")
                ->join(PHPFOX::getT("advancedmarketplace"), "l", "l.listing_id = p.listing_id")
				->join(PHPFOX::getT("user"), "u", "p.user_id = u.user_id")
                ->order('p.timestamp DESC');
        if ($iListingId !== NULL) {
            $oQuery->where(sprintf("l.listing_id = %d", $iListingId));
        }

        if ($iLimit !== NULL) {
            $oQuery->limit($iPage, $iLimit, $iCount);
        }

        return array($iCount, $oQuery->execute("getRows"));
    }

    //nhanlt
    public function backend_getcustomfieldinfos() {
        return array(
            /* PHPFOX::getPhrase */("advancedmarketplace.text_line") => array(
                "tag" => "<input type=\"text\" name=\"jh_#%name%#_\" value=\"jh_#%text%#_\" id=\"jh_#%id%#_\" class=\"jh_#%class%#_\" jh_#%custom_attribute%#_ />",
				"sub_tags" => NULL,
            ),
            /* PHPFOX::getPhrase */("advancedmarketplace.combo_box") => array(
                "tag" => "<select type=\"\" name=\"jh_#%name%#_\" value=\"jh_#%value%#_\" id=\"jh_#%id%#_\" class=\"jh_#%class%#_\ jh_#%custom_attribute%#_>jh_#%sub_tags%#_</select>",
				"sub_tags" => "<option value=\"jh_#%value%#_\">jh_#%text%#_</options>",
            ),
            /* PHPFOX::getPhrase */("advancedmarketplace.select_radio") => array(
                "tag" => "<label for=\"jh_#%id%#_\"><input type=\"radio\" name=\"jh_#%name_multi%#_\" value=\"jh_#%value%#_\" id=\"jh_#%id%#_\" class=\"jh_#%class%#_\ jh_#%custom_attribute%#_ />jh_#%value%#_</label>",
				"sub_tags" => "<label>jh_#%text%#_: <input type=\"radio\" value=\"jh_#%value%#_\" name=\"jh_#%name_multi%#_\"></label>",
            ),
            /* PHPFOX::getPhrase */("advancedmarketplace.select_checkbox") => array(
                "tag" => "<label for=\"jh_#%id%#_\"><input type=\"checkbox\" name=\"jh_#%name%#_\" value=\"jh_#%value%#_\" id=\"jh_#%id%#_\" class=\"jh_#%class%#_\" jh_#%custom_attribute%#_ />jh_#%text%#_</label>",
				"sub_tags" => NULL,
            ),
        );
    }


	public function frontend_getInterestedListings($iId)
	{

		$aCategories = phpfox::getLib('database')->select('cd.category_id')
					  ->from(phpfox::getT('advancedmarketplace_category_data'), 'cd')
					  ->where('cd.listing_id = '.$iId)
					  ->execute('getSlaveRows');
		$sCategories = '';
		foreach($aCategories as $iKey => $aCategory)
		{
			$sCategories .= $aCategory['category_id'].',';
		}
		$sCategories = substr($sCategories, 0, strlen($sCategories) - 1);
		$iCatId = phpfox::getService('advancedmarketplace.category')->getChildIdsOfCats($aCategories);

		if(empty($iCatId))
		{
			$iCatId['category_id'] = 0;
			return array(null, null);
		}
		$iCnt = phpfox::getLib('database')->select('count(cd.category_id)')
				->from(phpfox::getT('advancedmarketplace_category_data'), 'cd')
				->where('cd.listing_id ='.$iId)
				->execute('getSlaveField');
		$aListingIds = phpfox::getLib('database')->select('cd.listing_id')
					->from(phpfox::getT('advancedmarketplace_category_data'), 'cd')
					->where('cd.category_id = '.$iCatId['category_id'].' and cd.listing_id != '.$iId)
					->execute('getRows');
		$sListingIds = '';

		foreach($aListingIds as $iKey => $aId)
		{
			$sListingIds .= $aId['listing_id'].',';
		}
		if(empty($sListingIds))
		{
			return array(null, null);
		}
		$iCount = 0;
		$sListingIds = substr($sListingIds, 0, strlen($sListingIds) - 1);
		$aCounts = $this->database()->select('count(cd.listing_id) as iCnt')
					->from(phpfox::getT('advancedmarketplace_category_data'), 'cd')
					->join(phpfox::getT('advancedmarketplace'), 'l', 'l.listing_id = cd.listing_id')
				  	->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
					->where('cd.listing_id in ('.$sListingIds.') and l.post_status != 2 and l.view_id = 0 and l.privacy = 0')
					//->limit(phpfox::getParam('advancedmarketplace.total_listing_more_from'))
					->group('cd.listing_id')
					->having('count(cd.listing_id) = '.$iCnt )
					->execute('getRows');
		foreach($aCounts as $aCount)
		{
			$iCount += $aCount['iCnt'];
		}

		$aListings = phpfox::getLib('database')->select('l.*, '.phpfox::getUserField())
					->from(phpfox::getT('advancedmarketplace_category_data'), 'cd')
					->join(phpfox::getT('advancedmarketplace'), 'l', 'l.listing_id = cd.listing_id')
				  	->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
					->where('cd.listing_id in ('.$sListingIds.') and l.post_status != 2 and l.view_id = 0 and l.privacy = 0')
					->limit(phpfox::getParam('advancedmarketplace.total_listing_more_from'))
					->group('cd.listing_id')
					->having('count(cd.listing_id) = '.$iCnt )
					->execute('getRows');

		$this->_addCategoryUrl($aListings);
		return array($iCount, $aListings);
	}

	public function frontend_getSellerListings($iId, $iUserId)
	{
		$iCnt = $this->database()->select('COUNT(*)')
				  ->from(phpfox::getT('advancedmarketplace'), 'l')
				  ->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				  ->where('l.user_id = '.$iUserId.' and l.listing_id != '.$iId.' and l.post_status != 2 and l.view_id = 0')
				  //->group('l.listing_id')
				  ->execute('getSlaveField');
		$aListings = phpfox::getLib('database')->select('l.*, '.phpfox::getUserField())
				  ->from(phpfox::getT('advancedmarketplace'), 'l')
				  ->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
				  ->where('l.user_id = '.$iUserId.' and l.listing_id != '.$iId.' and l.post_status != 2 and l.view_id = 0')
				  ->limit(phpfox::getParam('advancedmarketplace.total_listing_more_from'))
				  ->group('l.listing_id')
				  ->execute('getRows');

		$this->_addCategoryUrl($aListings);
		return array($iCnt, $aListings);
	}

	public function getImagesOfListing($iId)
	{
		$aImage = phpfox::getLib('database')->select('image_path')
				 ->from(phpfox::getT('advancedmarketplace_image'))
				 ->where('listing_id = '.$iId)
				 ->execute('getRows');
		return $aImage;
	}

	public function getMostReviewedListing()
	{
		$aListings = array();
		$iCnt = phpfox::getLib('database')->select('count(*)')
				->from(phpfox::getT('advancedmarketplace'), 'l')
				->where('l.post_status != 2 and l.view_id = 0 and l.privacy = 0')
				->execute('getSlaveField');

		$aListings = phpfox::getLib('database')->select('l.*,'.phpfox::getUserField())
					->from(phpfox::getT('advancedmarketplace'), 'l')
					->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
					->where('l.post_status != 2 and l.view_id = 0 and l.privacy = 0')
					->limit(phpfox::getParam('advancedmarketplace.total_listing_more_from'))
					->group('l.listing_id')
					->order('l.total_rate desc, l.total_score desc')
					->execute('getRows');

		foreach ($aListings as $iKey => $aListing)
		{
			$fAVGRating = PHPFOX::getLib("database")
				->select("AVG(rating)")
				->from(PHPFOX::getT("advancedmarketplace_rate"))
				->where(sprintf("listing_id = %d", $aListing['listing_id']))
				->execute("getSlaveField");
			$iRatingCount = PHPFOX::getLib("database")
				->select("count(*)")
				->from(PHPFOX::getT("advancedmarketplace_rate"))
				->where(sprintf("listing_id = %d", $aListing['listing_id']))
				->execute("getSlaveField");

			$aListings[$iKey]['rating'] = $fAVGRating;
			$aListings[$iKey]['rating_count'] = $iRatingCount;
		}
		if (!empty($aListings) && is_array($aListings)) {
            foreach ($aListings as $iKey => $aListing) {
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
				$this->_convertFormatCurrency($aListings[$iKey]);
                
            }
        }
		return array($iCnt, $aListings);
	}

	public function frontend_getFeatureListings($iLimit)
	{
		$aListings = array();
		$aListings = phpfox::getLib('database')->select('l.title, l.listing_id, l.image_path, l.price, l.country_iso, l.time_stamp, l.currency_id, t.description, t.short_description,'.phpfox::getUserField())
					->from(phpfox::getT('advancedmarketplace'), 'l')
					->join(phpfox::getT('user'), 'u', 'u.user_id = l.user_id')
                	->join(phpfox::getT('advancedmarketplace_text'), 't', 't.listing_id = l.listing_id')
					->group('l.listing_id')
					->where('l.is_featured = 1 and l.post_status != 2 and l.privacy = 0 and l.view_id = 0')
					->order(" rand() ")
				 	->limit(4)
					->execute('getRows');
		$aListings = array_slice($aListings, 0, 4);
		if (!empty($aListings) && is_array($aListings)) {
            foreach ($aListings as $iKey => $aListing) {
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
                $this->_convertFormatCurrency($aListings[$iKey]);
            }
        }
		
		return $aListings;
	}

	public function getExistingReview($iItemId, $iUserId)
	{
		$aReview = phpfox::getLib('database')->select('r.rate_id')
				  ->from(phpfox::getT('advancedmarketplace_rate'), 'r')
				  ->where('r.listing_id = '.$iItemId.' and r.user_id = '.$iUserId)
				  ->execute('getField');

		return $aReview;
	}
	
	private function _convertFormatCurrency(&$aListing)
	{
		if($aListing['price']== 0)
		{
			return false;
		}
		
		switch($aListing['currency_id'])
		{
			case 'USD':
				$aListing['price'] = number_format((float)$aListing['price'], 2,  '.', ','); 
				break;
			default:
				$aListing['price'] = number_format((float)$aListing['price'], 2,  ',', '.'); 
				break;
		}
	}
	
	private function _addCategoryUrl(&$aListings)
	{
		if (!empty($aListings) && is_array($aListings)) 
		{
            foreach ($aListings as $iKey => $aListing) 
            {
                $sCategoryIds = phpfox::getService('advancedmarketplace.category')->getCategoryIds($aListing['listing_id']);
                $aCategoryIds = explode(',', $sCategoryIds);
                $iChildCat = $aCategoryIds[0];
                foreach ($aCategoryIds as $aCat) {
                    $iCat = phpfox::getService('advancedmarketplace.category')->getChildIds($aCat);
                    if (empty($iCat)) {
                        $iChildCat = $aCat;
                    }
                }
                $aCat = phpfox::getService('advancedmarketplace.category')->getForEdit($iChildCat);
                $aListings[$iKey]['url'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
                
            }
        }
	}

	// nhanlt
	public function buildSubCategory($aCategories, $level = 0, $cId, $iLevel = NULL) {
		if(empty($aCategories)) return false;
		if($iLevel <= 0) return false;
		// $level--;
		echo sprintf("<ul>");
		foreach($aCategories as $key=>$aCategory) {
			// if($aCategory["level"] >= $iLevel) return false;
			$sLIClass = "";
			if($aCategory["category_id"] == $cId){
				// ++$level;
				$sLIClass = "active";
			}
			$sf = $aCategory['level'];
			echo sprintf("<li class=\"submenu $sLIClass\"><a href=\"%s\">%s</a>", $aCategory['url'], $aCategory["name"]);
			if(!empty($aCategory["children"])) {
				$this->buildSubCategory($aCategory["children"], $level + 1, $cId, $iLevel - 1);
			}
			echo "</li>";
		}
		echo sprintf("</ul>");
	}
	
	public function getListingCoordinates()
	{
		$aListings = $this->database()->select('listing_id, lat, lng')
		->from(phpfox::getT('advancedmarketplace'))
		->execute('getRows');
	
		return $aListings;
	}
	
	public function getSetting()
	{
		$aSettings = array();
		
		
		$aLocationSetting = phpfox::getLib('database')->select('*')
					->from(phpfox::getT('advancedmarketplace_setting'))
					->where('var_name = "location_setting"')
					->execute('getRow');
		$aSettings['location_setting'] = (isset($aLocationSetting['value']))?$aLocationSetting['value']:'';
	
		return $aSettings;
	}
	public function getSettings()
	{

		$aSettings = array();
		
		$aLocationSetting = phpfox::getLib('database')->select('*')
					->from(phpfox::getT('advancedmarketplace_setting'))
					->where('var_name = "location_setting"')
					->execute('getRow');
		$aSettings['location_setting'] = (isset($aLocationSetting['value']))?$aLocationSetting['value']:'';
		return $aSettings;
	}
	public function getListingsByIds($aIds)
	{

		$sIds = join(',', $aIds);
		$aRows = $this->database()->select('listing_id, lat, lng, title, location, address, city')
		->from($this->_sTable)
		//->where("listing_id IN ($sIds)")
		->execute('getRows');

		foreach($aRows as $iKey => $aListing)
		{
			//$aEvent['start_time'] = Phpfox::getLib('date')->convertFromGmt($aEvent['start_time'], $aEvent['start_gmt_offset']);
			
			$aListing['link'] = Phpfox::getLib('url')->permalink('advancedmarketplace.detail', $aListing['listing_id'], $aListing['title']);
			$aRows[$iKey] = $aListing;
		}
		
		return $aRows;
	}

/**
 * If a call is made to an unknown method attempt to connect
 * it to a specific plug-in with the same name thus allowing
 * plug-in developers the ability to extend classes.
 *
 * @param string $sMethod is the name of the method
 * @param array $aArguments is the array of arguments of being passed
 */
public function __call($sMethod, $aArguments)
{
	/**
	 * Check if such a plug-in exists and if it does call it.
	 */
	if ($sPlugin = Phpfox_Plugin::get('advancedmarketplace.Service_AdvancedMarketplace__call'))
	{
		return eval($sPlugin);
	}

	/**
	 * No method or plug-in found we must throw a error.
	 */
	Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
}
}

?>
