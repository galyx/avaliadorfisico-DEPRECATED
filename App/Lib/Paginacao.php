<?php

namespace App\Lib;

class Paginacao
{
    private $totalPorPagina;
    private $totalLinhas;
    private $paginaSelecionada;

    public function __construct($resultado)
    {
        $this->totalLinhas          = $resultado['totalLinhas'];
        $this->totalPorPagina       = $resultado['totalPorPagina'];
        $this->paginaSelecionada    = $resultado['paginaSelecionada'];

    }

    public function criarLink($buscarAluno = "")
    {

        $quantidadePagina   = ceil( $this->totalLinhas / $this->totalPorPagina );
        $queryString        = (isset($buscarAluno)) ? "&buscarAluno=$buscarAluno" : "";
        $queryString       .= (!empty($this->totalPorPagina)) ? '&totalPorPagina=' . $this->totalPorPagina : '';
        
        $primeiraPagina     = 1;


        $html          = '<div class="row">';
        $html         .= '<div class="col-md-12 cenralizado">';
        $html         .= '<ul class="pagination pagination-sm">';
        $desabilita    = ( $this->paginaSelecionada == $primeiraPagina ) ? "disabled" : "";
        $html         .= "<li class='page-item $desabilita '>";
        $html         .= ( $this->paginaSelecionada == $primeiraPagina ) ? '<a href="#">&laquo; Anterior </a>' : '<a href="http://'. APP_HOST . '/aluno/selecionaraluno?paginaSelecionada=' . ( $this->paginaSelecionada - 1 ) . $queryString . '">&laquo; Anterior </a>';
        $html         .= '</li>';

        $html .= "<li class='page-item active'><a>".$this->paginaSelecionada." de ".$quantidadePagina."</a></li>";

        $desabilita    = ( $this->paginaSelecionada == $quantidadePagina ) ? "disabled" : "";
        $html         .= "<li class='page-item  $desabilita  '>";
        $html         .= ( $this->paginaSelecionada == $quantidadePagina ) ? '<a href="#">Próxima &raquo;</a>' : '<a href="http://'. APP_HOST . '/aluno/selecionaraluno?paginaSelecionada=' . ( $this->paginaSelecionada + 1 ) . $queryString . '">Próxima &raquo;</a>';
        $html         .= '</li>';
        $html         .= '</ul>';
        $html         .= '</div>';
        $html         .= '</div>';

        return $html;
    }
}