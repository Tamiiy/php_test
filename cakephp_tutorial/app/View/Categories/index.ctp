
<h1>Blog Categories</h1>

<?php echo $this->Html->link(
    'Add Category',
    array('controller' => 'Categories', 'action' => 'add')
    //出力：<a href="http://www.yourdomain.com/Categories/add.php">Add Category</a>
); ?>

<table>
    <tr>
        <th>Id</th>
        <th>User_id</th>
        <th>Category_name</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td><?php echo $category['Category']['user_id']; ?></td>
        <td>
            <?php echo $this->Html->link($category['Category']['category_name'],
array('controller' => 'Categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $category['Category']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])); ?>
        </td>
        <td><?php echo $category['Category']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>
