

<?php if( isset( $_GET['msg'] ) ): ?>
	<div style="color: red;"><?php echo $_GET['msg'] ?></div>
<?php endif; ?>

<form action="process.php" method="post">

<input type="text" name="amount" placeholder="Amount"> 

<select>
	<option value="981">GEL<option>
	<option value="840">USD<option>
	<option value="978">EUR<option>
</select>

<input type="submit" value="PAY">

</form>