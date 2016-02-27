<?php if(Session::get('pending_requests') > 1) { ?>
	<p>You have <?php echo Session::get('pending_requests'); ?> pending requests.</p>
<?php } else if (Session::get('pending_requests') == 1) { ?>
	<p>You have one pending request.</p>
<?php } else { ?>
	<p>You have no pending requests. Click <a href="#reward-request">Request a Reward</a> to make your first request.</p>
<?php } ?>
<p>Your last activity was on <?php echo date('F d, Y', strtotime(Session::get('last_activity'))); ?></p>