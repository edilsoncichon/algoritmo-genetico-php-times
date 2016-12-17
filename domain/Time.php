<?php

class Time {
    /**
     * @var array Jogador
     */
    private $Jogadores;
    /**
     * @var float
     */
    private $nota;
    /**
     * A ordem como os jogadores são posicionados no time.
     * @var array
     */
    private $posicoes;
    /**
     * @var int
     */
    private $qtd;

    /**
     * Time constructor.
     * @param array $posicoes
     */
    public function __construct(array $posicoes)
    {
        $this->qtd = 0;
        $this->Jogadores = [
            0 =>
                ['jogador' => null, 'nota' => 0.00],
            1 =>
                ['jogador' => null, 'nota' => 0.00],
            2 =>
                ['jogador' => null, 'nota' => 0.00],
            3 =>
                ['jogador' => null, 'nota' => 0.00],
            4 =>
                ['jogador' => null, 'nota' => 0.00],
            5 =>
                ['jogador' => null, 'nota' => 0.00],
            6 =>
                ['jogador' => null, 'nota' => 0.00],
            7 =>
                ['jogador' => null, 'nota' => 0.00],
            8 =>
                ['jogador' => null, 'nota' => 0.00],
            9 =>
                ['jogador' => null, 'nota' => 0.00],
            10 =>
                ['jogador' => null, 'nota' => 0.00],

        ];
        $this->posicoes = $posicoes;
    }

    /**
     * @return array
     */
    public function getPosicoes()
    {
        return $this->posicoes;
    }

    /**
     * @return array
     */
    public function getJogadores()
    {
        return $this->Jogadores;
    }

    /**
     * Seta um Jogador numa determinada Posição do Time.
     * @param int $index
     * @param Jogador $jogador
     * @throws Exception
     */
    public function setJogador($index, Jogador $jogador)
    {
        if ($this->qtd == 11)
            throw new Exception('Time cheio!');

        $this->Jogadores[$index]['jogador'] = $jogador;
        $this->qtd++;
        return;
    }

    /**
     * @param Posicao $pos
     * @param Jogador $jog
     * @return float
     */
    private function calcularNotaJogadorPosicao(Posicao $pos, Jogador $jog)
    {
        $nota = $pos->getReflexo() * $jog->getReflexo() +
            $pos->getForca() * $jog->getForca() +
            $pos->getHabilidade() * $jog->getHabilidade() +
            $pos->getVelocidade() * $jog->getVelocidade();
        return $nota;
    }

    /**
     * Faz a leitura dos jogadores e suas repectivas posições
     * e realizar cálculos conforme especificação.
     */
    public function calcularNotaTime()
    {
        foreach ($this->Jogadores as $index => $jogador) {
            $pos = $this->getPosicaoIndex($index);
            $notajogador = $this->calcularNotaJogadorPosicao($pos, $jogador['jogador']);

            $this->Jogadores[$index]['nota'] = $notajogador;
            $this->nota += $notajogador;
        }
    }

    /**
     * @return float
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * @return int
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * Extrai a primeira ou a segunda metade do time.
     *
     * @param bool $primeiraMetade
     * @return Time
     */
    public function getMetadeJogadores($primeiraMetade = true)
    {
        $start = 5;
        $lenght = 6;
        if ( $primeiraMetade ) {
            $start = 0;
            $lenght = 5;
        }
        return array_slice($this->Jogadores, $start, $lenght);
    }

    /**
     * Retorna a Posição referente ao índice que o jogador está no time.
     *
     * @param int $index
     * @return Posicao
     */
    private function getPosicaoIndex($index)
    {
        switch ($index){
            case 0:
                return $this->posicoes['goleiro'];
            case 1:
                return $this->posicoes['zagueiro'];
            case 2:
                return $this->posicoes['zagueiro'];
            case 3:
                return $this->posicoes['lateral'];
            case 4:
                return $this->posicoes['lateral'];
            case 5:
                return $this->posicoes['volante'];
            case 6:
                return $this->posicoes['volante'];
            case 7:
                return $this->posicoes['meia'];
            case 8:
                return $this->posicoes['meia'];
            case 9:
                return $this->posicoes['atacante'];
            case 10:
                return $this->posicoes['atacante'];
        }
    }
}
