<h1>Add Category</h1>
<?php
echo $this->Form->create('Category');
echo $this->Form->input('category_name');
//echo $this->Form->input('user_id');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Category');
?>