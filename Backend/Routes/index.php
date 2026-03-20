<?php

require_once __DIR__ . "/../Controllers/ProdutoController.php";

$rota = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$metodo = $_SERVER['REQUEST_METHOD'];


if($rota === "/produtos"){
    $produtoController = new ProdutoController();
    if($metodo === "GET"){
        $produtoController->listarProdutos();
    }
    if($metodo === "POST"){
        $produtoController->criarProduto();
    }
    if($metodo === "PUT" && isset($_GET['produto_id'])){
        $produtoController->atualizarProduto();
    }
    if($metodo === "DELETE" && isset($_GET['produto_id'])){
        $produtoController->deletarProduto();
    }
}