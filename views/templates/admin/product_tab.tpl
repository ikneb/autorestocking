{if $version }
    {if $has_combination}
        {include file="$has_comb_tpl" }
    {else}
        {include file="$not_comb_tpl" }
    {/if}
{else}

    {if $has_combination}
        {include file="$has_comb_tpl_new" }
    {else}
        {include file="$not_comb_tpl_new" }
    {/if}
{/if}
