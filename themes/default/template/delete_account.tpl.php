<?
	if($_POST['submit']) {
		if($_POST['password'] == $members['password']) {
			mysql_query("DELETE FROM activities WHERE userId='".$members['id']."'");
			mysql_query("DELETE FROM comments WHERE member_id='".$members['id']."'");
			mysql_query("DELETE FROM comments_votes WHERE user_id='".$members['id']."'");
			mysql_query("DELETE FROM news WHERE author='".$members['id']."'");
			mysql_query("DELETE FROM votes WHERE user_id='".$members['id']."'");
			mysql_query("DELETE FROM users WHERE id='".$members['id']."'");
			
			ob_start(); session_start(); session_start(); unset($_SESSION['id']); unset($_SESSION['username']); unset($_SESSION['oauth_provider']); unset($_SESSION['username']); session_destroy(); header('Location: '.$root.'');
		}
	}
?>
<section id="delete-account">
    <h2><?=$LANG['are_you_sure_you_want_to_delete_your_account'];?></h2>
    <p class="lead"><?=$LANG['this_will_delete_your_account'];?> <em><?=$members['username']?></em> <?=$LANG['and_all_of_its_content'];?>.</p>
    <div class="btn-container">
        <a class="btn" href="<?=$root;?>"> <?=$LANG['no_i_dont_want_to_do_that'];?></a>
        <a id="jsid-show-form-btn" class="thick" href="javascript:void(0);"> <?=$LANG['i_want_to_delete_my_account'];?>.</a>
    </div>

    <form id="delete-account" class="badge-delete-confirm-form modal" action="" method="POST" style="display:none;">
                    <div class="field">
                <label><?=$LANG['enter_password_title'];?></label>
                <input type="password" name="password" style="border: 1px solid #ccc;">
            </div>
                <div class="btn-container">
            <input type="submit" name="submit" value="<?=$LANG['delete_my_account_title'];?>">
        </div>
    </form>
</section>