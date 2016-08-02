<div style="margin-top: 56px;"></div>
<link rel="stylesheet" type="text/css" href="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/bootstrap.min.css" />
<script>
checked=false;
function checkedAll (form) {
var aa= document.getElementById('form');
if (checked == false)
{
checked = true;
}
else
{
checked = false;
}
for (var i =0; i < aa.elements.length; i++)
{
aa.elements[i].checked = checked;
}
}

</script>

<div id="admin_topmenu">
<a href="<?=$root;?>/view/admin/"><?=$LANG['TITLE_HOME'];?></a>
<a href="<?=$root;?>/view/admin/posts"><?=$LANG['TITLE_POSTS'];?></a>
<a href="<?=$root;?>/view/admin/users"><?=$LANG['TITLE_USERS'];?></a>
<a href="<?=$root;?>/view/admin/pages"><?=$LANG['TITLE_PAGES'];?></a>
<a href="<?=$root;?>/view/admin/categories"><?=$LANG['TITLE_CATEGORIES'];?></a>
<a href="<?=$root;?>/view/admin/comments"><?=$LANG['TITLE_COMMENTS'];?></a>
<a href="<?=$root;?>/view/admin/settings"><?=$LANG['TITLE_SETTINGS'];?></a>
</div>


<div id="admin_content">

<!-- Index Admin Page --><? if($_GET['action'] == '') {
include_once ('admin/index.tpl.php');
} ?> <!-- Index Admin Page -->

<!-- Posts Admin Page --><? if($_GET['action'] == 'posts') {
include_once ('admin/posts.tpl.php');
} ?> <!-- Posts Admin Page -->

<!-- Users Admin Page --><? if($_GET['action'] == 'users') {
include_once ('admin/users.tpl.php');
} ?> <!-- Users Admin Page -->

<!-- Pages Admin Page --><? if($_GET['action'] == 'pages') {
include_once ('admin/pages.tpl.php');
} ?> <!-- Pages Admin Page -->

<!-- Categories Admin Page --><? if($_GET['action'] == 'categories') {
include_once ('admin/categories.tpl.php');
} ?> <!-- Categories Admin Page -->

<!-- Comments Admin Page --><? if($_GET['action'] == 'comments') {
include_once ('admin/comments.tpl.php');
} ?> <!-- Comments Admin Page -->

<!-- Settings Admin Page --><? if($_GET['action'] == 'settings') {
include_once ('admin/settings.tpl.php');
} ?> <!-- Settings Admin Page -->

</div>