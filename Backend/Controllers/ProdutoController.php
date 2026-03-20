<?php

require_once __DIR__ . "/../Services/ProdutoService.php";

class ProdutoController {
    public $service;

    public function _construct() {
        $this->service = new ProdutoService();
    }

    public function listarProdutos () {
        echo json_encode($this->service->listarProdutos());
    }

    public function criarProduto () {
        $dados = json_decode(file_get_contents("php://input"), true);
        echo json_encode($this->service->criarProduto($dados));
    }

    public function atualizarProduto () {
        $dados = json_decode(file_get_contents("php://input"), true);
        $produtoId = $_GET['produto_id'];
        echo json_encode($this->service->criarProduto($dados, $produtoId));
    }

    public function deletarProduto () {
        $produtoId = $_GET['produto_id'];
        echo json_encode($this->service->criarProduto($produtoId));
    }
  
    
}