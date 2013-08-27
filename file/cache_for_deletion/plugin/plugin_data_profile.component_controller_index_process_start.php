<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = '//profile.component_controller_index_process_start

            $oDb = Phpfox::getLib(\'phpfox.database\');
            $aRewrite = $oDb->select(\'*\')
                        ->from(Phpfox::getT(\'rewrite\'))
                        ->where("replacement = \'".$sSection."\'")
                        ->execute(\'getRow\');
                    
            if(count($aRewrite))
            {
                $sSection = $aRewrite[\'url\'];
            } '; ?>