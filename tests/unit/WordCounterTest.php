<?php 
class WordCounterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $filePath;

	protected function _before()
    {
		$this->filePath = dirname(__DIR__) . '/_data/file.txt';
    }

    protected function _after()
    {
    }

    // tests
    public function testSplit()
    {
		$obj = new \prokhonenkov\wordcounter\WordCounter();
		$obj->setFilePath($this->filePath);

		$class = new \ReflectionClass($obj);

		$fileName = $class->getProperty('fileName');
		$fileName->setAccessible(true);

		$method = $class->getMethod('setText');
		$method->setAccessible(true);
		$method->invokeArgs($obj,[
			'text' => $fileName->getValue($obj)->getContent()
		]);

		$method = $class->getMethod('split');
		$method->setAccessible(true);
		$result = $method->invokeArgs($obj,[]);

		$this->assertTrue(is_array($result));
		$this->assertTrue(!empty($result));
    }

    public function testCount()
	{
		$obj = new \prokhonenkov\wordcounter\WordCounter();
		$obj->setFilePath($this->filePath);
		$result = $obj->count();

		$this->assertTrue($result === [
			'будет' => 2,
			'сегодня' => 2,
			'дождь' => 1,
			'не' => 1,
			'солнца' => 1
		]);
	}
}