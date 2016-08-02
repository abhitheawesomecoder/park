<?  $THEME_CONTENT_WRAP_RIGHT = 'off';  ?>
<div class="Container_Page">

<?  if($_GET['action'] == 'new') {
	if(isset($_POST['submit_setting'])) {
		$sendto = $_POST['sendto'];
        $message = $_POST['message'];

        $check_user_data = mysql_query("SELECT * FROM users WHERE username='".mysql_real_escape_string($sendto)."'");
        if(mysql_num_rows($check_user_data) >= 1) {
            $user = mysql_fetch_array($check_user_data);
            if($members['id'] != $user['id']) {
                $message_author = $members['id'];
                $message_receiver = $user['id'];
                $message_text = mysql_real_escape_string($message);
                $message_date = date("Y-m-d");
                $message_seen = '0';
                if($message_text != '') {
                    mysql_query("INSERT INTO messages (message_author, message_receiver, message_text, message_date) VALUES 
                                                  ('".$message_author."','".$message_receiver."','".$message_text."','".$message_date."')"); 
                    $_SESSION['success'] = "<span style='color: #33ad1f;'>".$LANG['TITLE_MESSAGES_SUCCESS']."</span>";
                    $_POST['submit_setting'] = '';
                    $_POST['sendto'] = '';
                    $_POST['message'] = '';
                    header('Location: /view/messages/new/success/');
                } else {
                    $_POST['error'] = $LANG['TITLE_MESSAGES_ERROR_1'];
                }
            } else {
                $_POST['error'] = $LANG['TITLE_MESSAGES_ERROR_2'];
            }
        } else {
            $_POST['error'] = $LANG['TITLE_MESSAGES_ERROR_3'];
        }
        //print success message. 
	}
	// Session Member Info
$members = get_members($id);
	  ?>  <!-- Index Action -->
<form id="setting" action="" method="POST">
    <h2><?=$LANG['TITLE_MESSAGES_SEND_MESSAGE'];?></h2>
    <p style="margin-top: 5px; color: #F00B0B; font-weight: bold;"><?php if($_GET['subaction'] == 'success') { echo $_SESSION['success']; $_SESSION['success'] = ''; } else { echo $_POST['error']; } ?></p>
    <div class="field">
        <label><?=$LANG['TITLE_MESSAGES_SENDTO'];?></label>
        <input type="text" name="sendto" value="<?php if($_GET['subaction'] == '') { echo $_POST['sendto']; } else { $detect_which = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='".mysql_real_escape_string($_GET['subaction'])."'")); echo $detect_which['username']; } ?>" maxlength="50" style="border: 1px solid #ccc;">
    </div>

    <div class="field">
        <label><?=$LANG['TITLE_MESSAGES_MESSAGE'];?></label>
        <textarea name="message" style="border: 1px solid #ccc; width: 440px; height: 100px;"><?=$_POST['message']?></textarea>
    </div>
      
    <div class="btn-container">
        <input name="submit_setting" type="submit" value="<?=$LANG['TITLE_MESSAGES_SEND_MESSAGE'];?>" style="padding: 9px 50px;">
    </div>
</form>
<?  }
elseif($_GET['action'] == 'delete') {
    if($_GET['subaction'] != '') {
        $detect_whose = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE message_id='".$_GET['subaction']."' LIMIT 1"));
        if($detect_whose['message_author'] == $members['id']) {
            echo "Author";
            $delete_action = mysql_query("UPDATE `messages` SET message_d1='1' WHERE message_id='".mysql_real_escape_string($_GET['subaction'])."'");
        }
        elseif($detect_whose['message_receiver'] == $members['id']) {
            echo "Receiver";
            $delete_action = mysql_query("UPDATE `messages` SET message_d2='1' WHERE message_id='".mysql_real_escape_string($_GET['subaction'])."'");
        }
        header('Location: /view/messages');
    }
}
else { ?> <!-- Messages Action -->
<form id="setting" action="" method="POST">
<h2><?=$LANG['TITLE_MESSAGES'];?></h2>
<style>
    .mtitle { color: #999; font-weight: bold; padding-left: 10px; padding-right: 10px; }
    .mttitle { padding-top: 10px; padding-bottom: 5px; padding-left: 10px; padding-right: 10px; }
    tr { outline: 2px solid rgba(229, 229, 229, 0); }
    tr:hover { background: #FFF; outline: 2px solid rgba(229, 229, 229, 0.34); transition: all .2s ease-in-out; cursor: pointer; }
</style>
    <table style="width: 540px; padding-top: 10px;">
        <tr>
            <td class="mtitle" style="width: 20%;"><?=$LANG['TITLE_MESSAGES_FROM'];?></td>
            <td class="mtitle" style="width: 63%;"><?=$LANG['TITLE_MESSAGES_MESSAGE'];?></td>
            <td class="mtitle" style="width: 7%;"><?=$LANG['TITLE_MESSAGES_ANSWER'];?></td>
            <td class="mtitle" style="width: 10%;"><?=$LANG['TITLE_MESSAGES_DELETE'];?></td>
        </tr>
        <?php
        $adjacents = 5;

        $query = mysql_query("SELECT COUNT(*) as num FROM messages WHERE message_author='".$members['id']."' AND message_d1='0' OR message_receiver='".$members['id']."' AND message_d2='0' ORDER BY message_id DESC");
        $total_pages = mysql_fetch_array($query);
        $total_pages = $total_pages['num'];

        $limit = 10;                            //how many items to show per page
        $page = $_GET['action'];

        if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
        else
        $start = 0;                             //if no page var is given, set start to 
        /* Get data. */
        $result = mysql_query("SELECT * FROM messages WHERE message_author='".$members['id']."' AND message_d1='0' OR message_receiver='".$members['id']."' AND message_d2='0' ORDER BY message_id DESC LIMIT $start, $limit");

        /* Setup page vars for display. */
        if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
        $prev = $page - 1;                          //previous page is page - 1
        $next = $page + 1;                          //next page is page + 1
        $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;                      //last page minus 1

        $pagination = "";
        if($lastpage > 1)
        {   
            $pagination .= "<div class=\"pagination\" style='padding-top: 10px; padding-bottom: 10px; text-align: center; width: 530px;'>";
            //previous button
            if ($page > 1) 
                $pagination.= "<a href=\"".$root."/view/messages/$prev/\"><i class='fa fa-chevron-circle-left' style='color: #2D72D9; font-size: 25px;'></i></a>";
            else
                $pagination.= "<span class=\"disabled\"><i class='fa fa-chevron-circle-left' style='color: #2D72D9; font-size: 25px;'></i></span>"; 

            //next button
            if ($page < $lastpage) 
                $pagination.= "<a href=\"".$root."/view/messages/$next/\" style='margin-left: 20px;'><i class='fa fa-chevron-circle-right' style='color: #2D72D9; font-size: 25px;'></i></a>";
            else
                $pagination.= "<span class=\"disabled\" style='margin-left: 20px;'><i class='fa fa-chevron-circle-right' style='color: #2D72D9; font-size: 25px;'></i></span>";
            $pagination.= "</div>\n";       
        }

        while($row = mysql_fetch_array($result)) {
            $from = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='".$row['message_author']."' LIMIT 1"));
        ?>
        <tr>
            <td class="mttitle"><img title="<?php echo $from['first_name'].' '.$from['last_name'].' @'.$from['username']; ?>" src="<?php if($from['oauth_provider'] == '') { ?><?php echo $root; ?>/uploads/avatars/<?php echo $from['photo']; ?><?php } else { echo $from['photo']; } ?>" width="80"></td>
            <td class="mttitle"><?php if($row['message_s2'] == '0' && $row['message_receiver'] == $members['id']) { echo "<strong>".$row['message_text']."</strong>"; } else { echo $row['message_text']; } ?></td>
            <td class="mttitle">
                <center><div class="btn-group btn-group-sm">
                    <a style="border-radius: 3px;" href="http://thai-park.com/view/messages/new/<?php echo $from['id']; ?>/" class="btn_td btn-success"><i class="fa fa-pencil"></i></a>
                </div></center>
            </td>
            <td class="mttitle">
                <center><div class="btn-group btn-group-sm">
                    <a style="border-radius: 3px;" href="http://thai-park.com/view/messages/delete/<?php echo $row['message_id']; ?>/" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');" class="btn_td btn-danger"><i class="fa fa-times"></i></a>
                </div></center>
            </td>
        </tr>
        <?php
        }
        if(mysql_num_rows($result) == '0') {
        ?>
        <tr>
            <td class="mttitle" colspan="4">
                <center>
                    <p style="margin-top: 15px; margin-bottom: 20px; color: #F00B0B; font-weight: bold;"><?=$LANG['TITLE_MESSAGES_ERROR_4'];?></p>
                </center>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
     if(mysql_num_rows($result) != '0') { echo $pagination; }
    ?>
</form>
<? } ?><!-- Password Action -->
            
    <ul class="form-nav">
        <li><a href="<?=$root;?>/view/messages/new" <? if($_GET['action'] == 'new') { echo 'class="selected"'; }?>><?=$LANG['TITLE_MESSAGES_SEND_MESSAGE'];?></a></li>
        <li><a href="<?=$root;?>/view/messages" <? if($_GET['action'] == '') { echo 'class="selected"'; }?>><?=$LANG['TITLE_MESSAGES'];?><?php if($count_messages_seen == '0') { echo ""; } else { echo " (".$count_messages_seen.")"; } ?></a></li>
    </ul>
    
<div class="clearfix"></div>
</div>
<?php
    $seen_query = mysql_query("SELECT * FROM messages WHERE message_author='".$members['id']."' AND message_d1='0' OR message_receiver='".$members['id']."' AND message_d2='0'");
    while($seen = mysql_fetch_array($seen_query)) {
        if($seen['message_author'] == $members['id']) {
            $update = mysql_query("UPDATE messages SET message_s1='1' WHERE message_id='".$seen['message_id']."'");
        }
        elseif($seen['message_receiver'] == $members['id']) {
            $update = mysql_query("UPDATE messages SET message_s2='1' WHERE message_id='".$seen['message_id']."'");
        }
    }
?>