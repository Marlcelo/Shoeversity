<?php
	include "../../database/get_notif_logs.php";
?>

<div class="notifs" id="admin-notifs-panel">
	<div class="row">
		<span onclick="closeNotifs()" class="pull-right" style="font-size:25px; color: #EEE; cursor: pointer; padding-right: 30px; padding-bottom: 8px">&times;</span>
	</div>
	<ul class="list-group list-special">
		<?php if(!empty($notifications)): ?>
			<?php foreach($notifications as $notif): ?>
				<li class="list-group-item">
					<?php
						echo $notif['username'] . ": ";
						echo $notif['log_action'] . " on ";
						echo $notif['time_stamp'];
					?>
				</li>
			<?php endforeach; ?>

		<?php else: ?>
			<li class="list-group-item">
				<span class="text-danger">No notifications are available at this time.</span>
			</li>

		<?php endif; ?>
	</ul>
	
	<button class="notifs-btn btn btn-primary" style="margin-top: -20px; border-radius: 0px !important;">
		<strong>View All Logs</strong>
	</button>
</div>