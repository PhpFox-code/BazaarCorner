{if $aListings}
{foreach from=$aListings key=iKey item=aListing}
    {template file='advancedmarketplace.block.listing-entry'}
{/foreach}
{/if}