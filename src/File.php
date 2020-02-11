<?php
/**
 * Created by Vitaliy Prokhonenkov <prokhonenkov@gmail.com>
 * Date 10.02.2020
 * Time 19:03
 */

namespace prokhonenkov\wordcounter;


class File
{
	private const EXTENSION_TXT = 'txt';

	private static $allowedExtensions = [
		self::EXTENSION_TXT
	];
	/**
	 * @var string
	 */
	private $fileName;

	/**
	 * File constructor.
	 * @param string $fileName
	 */
	public function __construct(string $fileName)
	{
		if(!file_exists($fileName)) {
			throw new \InvalidArgumentException('File not found');
		}

		$this->fileName = $fileName;

		if(!in_array($this->getExtension(), self::$allowedExtensions)) {
			throw new \InvalidArgumentException('Only .txt files');
		}
	}

	/**
	 * @return false|string
	 */
	public function getContent()
	{
		return file_get_contents($this->fileName);
	}

	/**
	 * @return string|string[]
	 */
	private function getExtension()
	{
		return pathinfo($this->fileName, PATHINFO_EXTENSION);
	}
}