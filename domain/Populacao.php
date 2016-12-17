<?php

class Populacao {

    /**
     * @var array
     */
    private $times;
    /**
     * @var bool
     */
    private $ordenado;

    /**
     * Populacao constructor.
     * @param array $times
     * @throws Exception
     */
    public function __construct(array $times = [])
    {
        if ( !is_array($times) )
            throw new Exception('Parâmetro *times* deve ser um array.');
        $this->times = $times;
        $this->ordenado = false;
    }

    /**
     * @return array
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * @param Time $time
     * @return $this
     */
    public function setTime(Time $time)
    {
        $this->times[] = $time;
        return $this;
    }

    /**
     * Ordena os times pela nota total.
     * @param bool $ordenacaoForcada
     * @return $this
     */
    public function ordenarPorNota($ordenacaoForcada = false)
    {
        if ( !$this->ordenado || $ordenacaoForcada) {
            usort($this->times, function (Time $a, Time $b) {
                if ($a->getNota() == $b->getNota())
                    return 0;
                return ($a->getNota() < $b->getNota()) ? -1 : 1;
            });
            $this->ordenado = true;
        }
        return $this;
    }

    /**
     * Descarta os 100 indivíduos de menor nota.
     *
     * @return $this
     */
    public function descartar100Piores()
    {
        if ( !$this->ordenado )
            $this->ordenarPorNota();
        $this->times = array_slice($this->times, 100, 199);
        return $this;
    }
}
