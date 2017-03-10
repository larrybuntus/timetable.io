<a href="#" id="message-updater" dest="<?php echo $_SESSION['url'] ?>/home/chat/update.php"></a>
<div class="chat-container">
	<div class="chat-header">
		<p class="text-center"><a href="" id="open-chat" dest="<?php echo $_SESSION['url'] ?>/home/chat/update.php"><?php echo $func->trim($_SESSION['programme'], 20).' '.$_SESSION['year']; ?></a></p>
		<p class="pull-right repo-toggle-button"><a href="" dest="<?php echo $_SESSION['url'] ?>/home/repo/update.php"><i class="fa fa-file-text-o fa-fw"></i></a></p>
		<p class="down-chat"><a href=""><i class="fa fa-angle-double-down fa-fw"></i></a></p>

		<div class="chat-drop-menu">
			<nav>
				<ul class="nav navbar nav nav-pills pull-right">
					<li><a href="" class="reply-chat"><i class="fa fa-reply fa-fw"></i></a></li>
					<li><a href="" class="copy-chat"><i class="fa fa-copy fa-fw"></i></a></li>
					<li><a href="" class="trash-chat"><i class="fa fa-trash fa-fw"></i></a></li>
					<li><a href="#" class="chat-counter"></a></li>
					<li class="hidden delete-message-ids" dest="<?php echo $_SESSION['url']; ?>/home/chat/delete.php"></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="chat-body">
		
	</div>
	<div class="chat-footer">
		<form id="chatForm" dest="<?php echo $_SESSION['url'] ?>/home/chat/message.php">
			<div class="message-body">
				<textarea type="text" class="form-control filter-input autoExpand" placeholder="Type a message" name="message" required="true" autofocus="true" rows='1' data-min-rows="1" id="myMessage"></textarea>
			</div>
			<div class="send-button">
				<button type="submit" class="btn btn-primary" id="send-button"><i class="fa fa-send fa-fw"></i></button>
			</div>	
		</form>
	</div>
</div>
