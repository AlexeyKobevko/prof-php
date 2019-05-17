<?php


abstract class Good
{
    protected $name;
    protected $basedCost;
    protected static $profit;

    public function __construct(string $name, float $basedCost)
    {
        $this->name = $name;
        $this->basedCost = $basedCost;
        self::$profit;
    }

    abstract protected function getFinalCost();
    abstract public function sell(int $quantity);

    public function printFinalCost()
    {
        echo "<div>Товар {$this->name} стоит {$this->getFinalCost()}</div>";
    }

    public static function showProfit() {
        echo self::$profit;
    }
}

class PieceGoods extends Good
{
    public function __construct($name, $basedCost = 100)
    {
        parent::__construct($name, $basedCost);
    }

    protected function getFinalCost() : float
    {
        return $this->basedCost;
    }

    public function sell($quantity) {
        $sum = $quantity * $this->getFinalCost();
        return self::$profit += $sum;
    }
}

class DigitalGood extends PieceGoods
{

    protected function getFinalCost() : float
    {
        return $this->basedCost / 2;
    }
}

class WeightGood extends PieceGoods
{
    protected $weight;

    public function __construct($name, $weight, $basedCost = 100)
    {
        parent::__construct($name, $basedCost);
        $this->weight = $weight;
    }

    protected function getCost()
    {
        if ($this->weight > 2000)
            return $this->basedCost * 0.7;
        elseif ($this->weight > 1000 && $this->weight <= 2000)
            return $this->basedCost * 0.8;
        else
            return $this->basedCost;
    }

    protected function getFinalCost() : float
    {
        return $this->weight / 1000 * $this->getCost();
    }

    public function printFinalCost()
    {

        echo "<div>{$this->weight} грамм товара {$this->name} стоит {$this->getFinalCost()}</div>";
    }

    public function sell($quantity) : float
    {

        return self::$profit += $this->getFinalCost();
    }
}

$pg = new PieceGoods('TV Samsung');
$dg = new DigitalGood('Windows 10 Home Edition');
$wg = new WeightGood('Chupa-Chups', 3210);

$pg->sell(2);
$dg->sell(1);
$wg->sell(2311);

Good::showProfit();