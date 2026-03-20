<?php
require_once __DIR__ . "/../Connection/db.php";
require_once __DIR__ . "/../Validators/ProdutoValidator.php";

class ProdutoService {
    public $db; 

    public function _construct(){
        $this->db = db();
    }

    public function listarProdutos () {
        $stmt = $this->db->query("SELECT * FROM produtos");
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $produtos;
    }


    public function criarProduto ($dados) {
    $erros = ProdutoValidator::validarProduto($dados, $this->db);

    if(!empty($erros)){
    http_response_code(400);
    return [
        'message' => 'Erro de validação',
        'Erros' => $erros
    ];
    }

    $stmt = $this->db->prepare("INSERT INTO usuarios (nome, descricao, preco, estoque, categoria)
    VALUES (:nome, :descricao, :preco, :estoque, :categoria)");

    $stmt->execute([":nome" => $dados['nome'], ":descricao" => $dados['descricao'], ":preco" => $dados['preco'], 
    ":estoque" => $dados['estoque'], ":categoria" => $dados['categoria']]);

    http_response_code(201);
    return [
        'message' => 'Produto criado com sucesso'
    ];

    }

     public function atualizarProduto ($dados, $produtoId) {
        $erros = ProdutoValidator::validarProduto($dados, $this->db);

    if(!empty($erros)){
    http_response_code(400);
    return [
        'message' => 'Erro de validação',
        'Erros' => $erros
    ];
    }

    $find = $this->db->prepare("SELECT id FROM produtos WHERE id = :id");
    $find->execute([":id" => $produtoId]);
    $produto = $find->fetch(PDO::FETCH_ASSOC);

    if(empty($produto)){
        http_response_code(404);
        return [
            'message' => 'Produto não encontrado'
        ];
    }

    $stmt = $this->db->prepare("UPDATE set produtos nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, categoria = :categoria WHERE id = :id");
    $stmt->execute([":id" => $produtoId, ":nome" => $dados['nome'], ":descricao" => $dados['descricao'], ":preco" => $dados['preco'], ":estoque" => $dados['estoque'],
    ":categoria" => $dados['categoria']]);

    http_response_code(200);
    return [
        'message' => 'Produto atualizado com sucesso'
    ];


    }

     public function deletarProduto ($produtoId) {
         $find = $this->db->prepare("SELECT id FROM produtos WHERE id = :id");
    $find->execute([":id" => $produtoId]);
    $produto = $find->fetch(PDO::FETCH_ASSOC);

    if(empty($produto)){
        http_response_code(404);
        return [
            'message' => 'Produto não encontrado'
        ];
    }

    $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->execute([":id" => $produtoId]);

    http_response_code(200);
    return [
        'message' => 'Produto deletado'
    ];
    }

}
