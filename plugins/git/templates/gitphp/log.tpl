{*
 *  log.tpl
 *  gitphp: A PHP git repository browser
 *  Component: Log view template
 *
 *  Copyright (C) 2009 Christopher Han <xiphux@gmail.com>
 *}
{include file='header.tpl'}

 {* Nav *}
 <div class="page_nav">
   {include file='nav.tpl' current='log' logcommit=$commit treecommit=$commit logmark=$mark}
   <br />
   {if ($commit && $head) && (($commit->GetHash() != $head->GetHash()) || ($page > 0))}
     <a href="{$SCRIPT_NAME}?a=log{if $mark}&amp;m={$mark->GetHash()|urlencode}{/if}">{t}HEAD{/t}</a>
   {else}
     {t}HEAD{/t}
   {/if}
   &sdot; 
   {if $page > 0}
     <a href="{$SCRIPT_NAME}?a=log&amp;h={$commit->GetHash()|urlencode}&amp;pg={$page-1}{if $mark}&amp;m={$mark->GetHash()|urlencode}{/if}" accesskey="p" title="Alt-p">{t}prev{/t}</a>
   {else}
     {t}prev{/t}
   {/if}
   &sdot; 
   {if $hasmorerevs}
     <a href="{$SCRIPT_NAME}?a=log&amp;h={$commit->GetHash()|urlencode}&amp;pg={$page+1}{if $mark}&amp;m={$mark->GetHash()|urlencode}{/if}" accesskey="n" title="Alt-n">{t}next{/t}</a>
   {else}
     {t}next{/t}
   {/if}
   <br />
   {if $mark}
     {t}selected{/t} &sdot;
     <a href="{$SCRIPT_NAME}?a=commit&amp;h={$mark->GetHash()|urlencode}" class="list commitTip" {if strlen($mark->GetTitle()) > 30}title="{$mark->GetTitle()|htmlspecialchars}"{/if}><strong>{$mark->GetTitle(30)|escape:'html'}</strong></a>
     &sdot;
     <a href="{$SCRIPT_NAME}?a=log&amp;h={$commit->GetHash()|urlencode}&amp;pg={$page|urlencode}">{t}deselect{/t}</a>
     <br />
   {/if}
 </div>
 {foreach from=$revlist item=rev}
   <div class="title">
     <a href="{$SCRIPT_NAME}?a=commit&amp;h={$rev->GetHash()|urlencode}" class="title"><span class="age">{$rev->GetAge()|agestring}</span>{$rev->GetTitle()|escape:'html'}</a>
     {include file='refbadges.tpl' commit=$rev}
   </div>
   <div class="title_text">
     <div class="log_link">
       {assign var=revtree value=$rev->GetTree()}
       <a href="{$SCRIPT_NAME}?a=commit&amp;h={$rev->GetHash()|urlencode}">{t}commit{/t}</a> | <a href="{$SCRIPT_NAME}?a=commitdiff&amp;h={$rev->GetHash()|urlencode}">{t}commitdiff{/t}</a> | <a href="{$SCRIPT_NAME}?a=tree&amp;h={$revtree->GetHash()|urlencode}&amp;hb={$rev->GetHash()|urlencode}">{t}tree{/t}</a>
       <br />
       {if $mark}
         {if $mark->GetHash() == $rev->GetHash()}
	   <a href="{$SCRIPT_NAME}?a=log&amp;h={$commit->GetHash()|urlencode}&amp;pg={$page|urlencode}">{t}deselect{/t}</a>
	 {else}
	   {if $mark->GetCommitterEpoch() > $rev->GetCommitterEpoch()}
	     {assign var=markbase value=$mark}
	     {assign var=markparent value=$rev}
	   {else}
	     {assign var=markbase value=$rev}
	     {assign var=markparent value=$mark}
	   {/if}
	   <a href="{$SCRIPT_NAME}?a=commitdiff&amp;h={$markbase->GetHash()|urlencode}&amp;hp={$markparent->GetHash()|urlencode}">{t}diff with selected{/t}</a>
	 {/if}
       {else}
         <a href="{$SCRIPT_NAME}?a=log&amp;h={$commit->GetHash()|urlencode}&amp;pg={$page}&amp;m={$rev->GetHash()|urlencode}">{t}select for diff{/t}</a>
       {/if}
       <br />
     </div>
     <em>{$rev->GetAuthorName()|escape} [{$rev->GetAuthorEpoch()|date_format:"%a, %d %b %Y %H:%M:%S %z"}]</em><br />
   </div>
   <div class="log_body">
     {assign var=bugpattern value=$project->GetBugPattern()}
     {assign var=bugurl value=$project->GetBugUrl()}
     {foreach from=$rev->GetComment() item=line}
       {if strncasecmp(trim($line),'Signed-off-by:',14) == 0}
       <span class="signedOffBy">{$line|htmlspecialchars|buglink:$bugpattern:$bugurl}</span>
       {else}
       {$line|htmlspecialchars|buglink:$bugpattern:$bugurl}
       {/if}
       <br />
     {/foreach}
     {if count($rev->GetComment()) > 0}
       <br />
     {/if}
   </div>
 {foreachelse}
   <div class="title">
     <a href="{$SCRIPT_NAME}?a=summary" class="title">&nbsp</a>
   </div>
   <div class="page_body">
     {if $commit}
       {assign var=commitage value=$commit->GetAge()|agestring}
       {t 1=$commitage}Last change %1{/t}
     {else}
     <em>{t}No commits{/t}</em>
     {/if}
     <br /><br />
   </div>
 {/foreach}

 {include file='footer.tpl'}

