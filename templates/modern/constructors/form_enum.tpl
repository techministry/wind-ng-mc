{* Modern theme enum label resolver *}
{assign var=temp value=$fullField|cat:"-"|cat:$value}
{if isset($lang.db.$temp) && $lang.db.$temp != ''}{$lang.db.$temp}{else}{$value|escape}{/if}
