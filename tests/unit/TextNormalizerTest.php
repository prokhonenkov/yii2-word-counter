<?php 
class TextNormalizerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $text = 'мама мыла раму !"№;%:?*()_ 1';
    private $textFinal = 'мама мыла раму';

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testClear()
    {
    	$obj = new \prokhonenkov\wordcounter\TextNormalizer($this->text);
		$class = new \ReflectionClass($obj);
		$method = $class->getMethod('clear');
		$method->setAccessible(true);
		$property = $class->getProperty('text');
		$property->setAccessible(true);
		$method->invokeArgs($obj,[]);

		$value = $property->getValue($obj);

		$this->assertTrue(trim($value) === $this->textFinal);
    }

    public function testToLower()
    {
    	$obj = new \prokhonenkov\wordcounter\TextNormalizer(mb_strtoupper($this->textFinal));
		$class = new \ReflectionClass($obj);
		$method = $class->getMethod('toLower');
		$method->setAccessible(true);
		$property = $class->getProperty('text');
		$property->setAccessible(true);
		$method->invokeArgs($obj,[]);

		$value = $property->getValue($obj);

		$this->assertTrue(trim($value) === $this->textFinal);
    }

    public function testNormalize()
    {
    	$obj = new \prokhonenkov\wordcounter\TextNormalizer($this->text);
		$this->assertTrue($obj->normalize() === $this->textFinal);
    }
}