<?php
use yii\helpers\Url;
?>

<h2>Users</h2>
<a href="<?=Url::to(['users/edit'])?>">Add New</a>
<table id="users">
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>role</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?=$user->getId()?></td>
            <td><?=$user->username?></td>
            <td><?=$user->getRoleString()?></td>
            <td><?=$user->getStatusString()?></td>
            <td><a href="<?=Url::to(['users/edit', 'id' => $user->getId()])?>">edit</a></td>
            <td><a href="<?=Url::to(['users/delete', 'id' => $user->getId()])?>">delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>