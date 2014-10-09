<h1>Add Post</h1>
<?php
echo $this->Form->create('Post'); //Formタグ
echo $this->Form->input('title'); //inputタグ
echo $this->Form->input('body', array('rows' => '3')); //textareaタグ
echo $this->Form->end('Save Post'); //submitボタン
?>
