<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h1>Dashboard</h1>

    <h2>Contests</h2>
    <p>
        <a class="btn btn-lg btn-primary" href="<?=Url::to(['contest-current/index'])?>">Current</a>
        <a class="btn btn-lg btn-primary" href="<?=Url::to(['contest-category/index'])?>">Categories</a>
        <a class="btn btn-lg btn-primary" href="<?=Url::to(['contest-type/index'])?>">Types</a>
        <a class="btn btn-lg btn-primary" href="<?=Url::to(['structure/index'])?>">Structures</a>
    </p>

    <h2>Locations</h2>
    <p>
        <a class="btn btn-lg btn-success" href="<?=Url::to(['location/index'])?>">Locations</a>
        <a class="btn btn-lg btn-success" href="<?=Url::to(['subregion/index'])?>">Subregions</a>
        <a class="btn btn-lg btn-success" href="<?=Url::to(['region/index'])?>">Regions</a>
    </p>

    <h2>Users</h2>
    <p>
        <a class="btn btn-lg btn-danger" href="<?=Url::to(['user/index'])?>">Users</a>
    </p>

</div>
