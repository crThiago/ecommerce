<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;

$app->get('/admin/products', function(){
    User::verifyLogin();

    $products = Product::listAll();

    $page = new pageAdmin();

    $page->setTpl("products", array("products" => $products));
});

$app->get('/admin/products/create', function(){
    User::verifyLogin();

    $page = new pageAdmin();

    $page->setTpl("products-create");
});

$app->post('/admin/products/create', function(){
    User::verifyLogin();

    $product = new Product();
    
    $product->setData($_POST);

    $product->save();

    header("Location: /admin/products");
    exit;
});

$app->get('/admin/products/:idProduct', function($idProduct){
    User::verifyLogin();

    $product = new Product();
    
    $product->get((int)$idProduct);

    $page = new PageAdmin();

    $page->setTpl("products-update", array(
        'product'=>$product->getValues()
    ));
});

$app->post('/admin/products/:idProduct', function($idProduct){
    User::verifyLogin();

    $product = new Product();
    
    $product->get((int)$idProduct);

    $product->setData($_POST);

    $product->save();

    $product->setPhoto($_FILES['file']);

    header('Location: /admin/products');
    exit;
});

$app->get('/admin/products/:idProduct/delete', function($idProduct){
    User::verifyLogin();

    $product = new Product();
    
    $product->get((int)$idProduct);

    $product->delete();

    header('Location: /admin/products');
    exit;
});


