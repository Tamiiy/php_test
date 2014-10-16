<h1><?php echo h($posts['Category']['category_name']); ?></h1>

<p><small>Created: <?php echo $posts['Category']['created']; ?></small></p>

<p><?php echo h($posts['Category']['user_id']); ?></p>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

    <?php foreach ($posts['Post'] as $post): ?>
    <tr>
        <td><?php echo $post['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['title'],
array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['id'])); ?>
        </td>
        <td><?php echo $post['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>
