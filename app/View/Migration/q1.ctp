<div class="row-fluid">
	location of xls: files/migration_sample_1.xls
<?php
echo $this->Form->create('migrate', ['type' => 'file']);
echo $this->Form->submit('Click Migrate (This will replace the previous data)', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>

	<hr />

	<div class="alert alert-success">
		<h3>Data Migrated</h3>
	</div>

	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach($members as $m):?>
			<tr>
				<th><?php echo $m['Members']['id']?></th>
				<th><?php echo $m['Members']['name']?></th>
				<th><?php echo $m['Members']['created']?></th>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>