<?php 
class SortTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $amountOfWords = [
		'сегодня' => 2,
		'дождь' => 1,
    	'будет' => 2,
		'солнца' => 1,
		'не' => 1
	];

    protected function _before()
    {
    }

    protected function _after()
    {
    }

	public function callMethod($obj, $name, array $args) {;
		$class = new \ReflectionClass($obj);
		$method = $class->getMethod($name);
		$method->setAccessible(true);
		return $method->invokeArgs($obj, $args);
	}

    // tests
    public function testSortByValue()
    {
		$result = $this->callMethod(new \prokhonenkov\wordcounter\Sort($this->amountOfWords), 'sortByValue', [
			'someArray' => $this->amountOfWords
		]);

		$this->assertTrue(array_values($result) === [2,2,1,1,1]);
    }

    public function testSortByKey()
    {
		$result = $this->callMethod(new \prokhonenkov\wordcounter\Sort($this->amountOfWords), 'sortBykey', [
			'someArray' => $this->amountOfWords
		]);

		$this->assertTrue(array_keys($result) === ['будет', 'дождь', 'не', 'сегодня', 'солнца']);
    }

    public function testExecute()
	{
		$result = (new \prokhonenkov\wordcounter\Sort($this->amountOfWords))->execute();

		$this->assertTrue($result === [
			'будет' => 2,
			'сегодня' => 2,
			'дождь' => 1,
			'не' => 1,
			'солнца' => 1
		]);
	}
}
