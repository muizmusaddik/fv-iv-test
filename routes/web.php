<?php

$app->get('/', function () use ($app) {
    return "FashionValet Interview Test - Abdul Mu'iz Bin Abu Bakar Musaddik";
});

$app->get('/base', 'Controller@getResult');
$app->get('/special-1', 'SpecializedOne@getResult');
$app->get('/special-2', 'SpecializedTwo@getResult');
