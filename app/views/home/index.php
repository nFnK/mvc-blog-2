<?php render('_header',array('title'=>$title))?>

<?php if(Session::get('loggin') != true) { ?>
<p>Welcome Guest!</p>
<p>Please click <a href="?controller=login&action=login">here</a> to Login.
<?php } else { ?>
<p><h3>Welcome <?php echo Session::get('firstname') . " " . Session::get('lastname'); ?></h3></p>
<p>Your last activity was on <?php echo date('F d, Y', strtotime(Session::get('last_activity'))); ?></p>
<?php } ?>
<?php render('_footer')?>