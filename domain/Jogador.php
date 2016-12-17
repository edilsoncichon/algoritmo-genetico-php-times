<?php

class Jogador {
    private $nome;
    private $reflexo;
    private $forca;
    private $velocidade;
    private $habilidade;

    /**
     * Jogador constructor.
     * @param $nome
     * @param $reflexo
     * @param $forca
     * @param $velocidade
     * @param $habilidade
     * @param \TimeAlgoGen\domain\Posicao $posicao
     */
    public function __construct($nome, $reflexo, $forca, $velocidade, $habilidade)
    {
        $this->nome = $nome;
        $this->reflexo = $reflexo;
        $this->forca = $forca;
        $this->velocidade = $velocidade;
        $this->habilidade = $habilidade;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getReflexo()
    {
        return $this->reflexo;
    }

    /**
     * @param mixed $reflexo
     */
    public function setReflexo($reflexo)
    {
        $this->reflexo = $reflexo;
    }

    /**
     * @return mixed
     */
    public function getForca()
    {
        return $this->forca;
    }

    /**
     * @param mixed $forca
     */
    public function setForca($forca)
    {
        $this->forca = $forca;
    }

    /**
     * @return mixed
     */
    public function getVelocidade()
    {
        return $this->velocidade;
    }

    /**
     * @param mixed $velocidade
     */
    public function setVelocidade($velocidade)
    {
        $this->velocidade = $velocidade;
    }

    /**
     * @return mixed
     */
    public function getHabilidade()
    {
        return $this->habilidade;
    }

    /**
     * @param mixed $habilidade
     */
    public function setHabilidade($habilidade)
    {
        $this->habilidade = $habilidade;
    }
}