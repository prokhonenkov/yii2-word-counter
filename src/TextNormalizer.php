<?php
/**
 * Created by Vitaliy Prokhonenkov <prokhonenkov@gmail.com>
 * Date 10.02.2020
 * Time 17:18
 */

namespace prokhonenkov\wordcounter;


class TextNormalizer
{
	/**
	 * @var string
	 */
	private $text;

	/**
	 * TextNormalizer constructor.
	 * @param string $text
	 */
	public function __construct(string $text)
	{
		$this->text = $text;
	}

	private function clear(): void
	{
		$this->text = preg_replace("/\n|\r\n|/", '', $this->text);
		$this->text = preg_replace('/[^ a-zа-яё]/ui', ' ', $this->text);
	}

	private function convertToUtf8(): void
	{
		$this->text = iconv(
			mb_detect_encoding($this->text, mb_detect_order(), true),
			"UTF-8",
			$this->text
		);
	}

	private function toLower(): void
	{
		$this->text = mb_strtolower($this->text);
	}

	/**
	 * @return string
	 */
	public function normalize(): string
	{
		$this->convertToUtf8();
		$this->toLower();
		$this->clear();

		return trim($this->text);
	}
}