<? if(TURN_PAGES == '1') { ?>
<ul id="pages_ul">
  <? $SECTION['pages'] = mysql_query("SELECT * FROM pages WHERE status='on'");while($SECTION_pages_ROW = mysql_fetch_array($SECTION['pages'])) { ?>
  <li class="pages_li"><a href="<?=$root;?>/pages/<?=$SECTION_pages_ROW['page_id'];?>" class="pages_li_a"><?=$SECTION_pages_ROW['page_title'];?></a></li>
  <? } ?>
</ul>
<? } ?>
<div style="width: 630px;">
<h2 style="font-size: 26px; line-height: 1.3em; margin-bottom: 7px; font-family: Arial,Helvetica,Geneva,sans-serif;"><?=$media['page_title'];?></h2>
<div style="font-size: 14px;"><?=$media['text'];?></div>
</div>