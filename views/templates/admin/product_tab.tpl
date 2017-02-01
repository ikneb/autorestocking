{**
* 2016 WeeTeam
*
* @author    WeeTeam
* @copyright 2016 WeeTeam
* @license   http://www.gnu.org/philosophy/categories.html (Shareware)
*}

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
