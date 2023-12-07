<?php
class Favorito{
    public $id;
    public $titulo;
    public $capa_livro;

    public function __construct($id, $titulo, $capa_livro){
        $this->id = $id;
        $this->titulo= $titulo;
        $this->capa_livro = $capa_livro;
    }


    public function getFavorito()
    {
        $_SESSION['favorito'][$this->id] = [
            'id' => "{$this->id}",
            'titulo' => "{$this->titulo}",
            'capa_livro' => "{$this->capa_livro}",
        ];
    }
}
