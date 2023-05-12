<?php include_once("../init.php"); ?>

<?php $listIl = $db->query("SELECT * FROM ilceler WHERE il_id = '$_POST[il_id]'"); ?>
<?php foreach ($listIl as $list) { ?>
	<option value="<?php echo $list['id']; ?>"><?php echo $list['ilce_adi']; ?></option>
<?php } ?>