{* WiND - Modern Material Theme - Link *}
{if $confirm == TRUE}{assign var=link value="javascript: if (confirm('$content?') == true) window.open('$link','_parent');"}{/if}
<a href="{$link}"{if $onclick != ''} onclick="{$onclick}"{/if}{if $target != ''} target="{$target}"{/if} class="mdc-button mdc-button--outlined mdc-theme--primary" style="margin:0 4px;">{$content}</a>