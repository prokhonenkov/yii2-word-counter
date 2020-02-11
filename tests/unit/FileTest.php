<?php 
class FileTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
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
    public function testInvalidPathname()
    {
		try {
			$file = new \prokhonenkov\wordcounter\File(dirname(__DIR__) . '/_datafile.txt');
		} catch (\Exception $e) {
			$this->assertEquals('File not found', $e->getMessage());
		}
    }

    public function testInvalidExtension()
	{
		try {
			$file = new \prokhonenkov\wordcounter\File(dirname(__DIR__) . '/_data/file.xml');
		} catch (\Exception $e) {
			$this->assertEquals('Only .txt files', $e->getMessage());
		}
	}

	public function testGetContent()
	{
		$file = new \prokhonenkov\wordcounter\File(dirname(__DIR__) . '/_data/file.txt');
		$this->assertTrue(strpos($file->getContent(), 'солнца не будет') !== false);
	}

	public function testGetExtension()
	{
		$result = $this->callMethod(
			new \prokhonenkov\wordcounter\File(dirname(__DIR__) . '/_data/file.txt'),
			'getExtension',
			[]
		);

		$this->assertTrue($result === 'txt');
	}
}