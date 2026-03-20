<?php


class ProdutoValidator {
    public static function validarProduto ($dados, $db) {
    $erros = [];

    if(empty($dados['nome'])){
        $erros['nome'] = 'Nome inválido';
    }

    if(empty($dados['descricao'])){
        $erros['descricao'] = 'Descricao inválida';
    }

    if(empty($dados['preco'])){
        $erros['preco'] = 'Preco inválido';
    }

    if(empty($dados['estoque'])){
        $erros['estoque'] = 'Estoque inválido';
    }

    if(empty($dados['categoria'])){
        $erros['categoria'] = 'Categoria inválida';
    }

    return $erros;
    }
}