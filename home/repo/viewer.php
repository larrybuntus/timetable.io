<?php if ($_POST['query'] == 'pdf'): ?>	
<iframe width="100%" src="<?php echo $_POST['value'] ?>" frameborder="0" style="min-height: 80vh;"></iframe>
<?php exit(); endif ?>

<?php if ($_POST['query'] == 'img'): ?>
<img src="<?php echo $_POST['value']; ?>" alt="" class="img-responsive center-block">
<?php endif ?>
