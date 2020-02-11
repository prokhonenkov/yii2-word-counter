<?php
/**
 * Created by Vitaliy Prokhonenkov <prokhonenkov@gmail.com>
 * Date 10.02.2020
 * Time 17:03
 */

namespace prokhonenkov\wordcounter;


class WordCounter
{
	/**
	 * @var string
	 */
	private $text;
	/**
	 * @var string
	 */
	private $fileName;

	/**
	 * @param string $text
	 */
	private function setText(string $text): void
	{
		$this->text = (new TextNormalizer($text))->normalize();
		return;
	}

	/**
	 * @param string $fileName
	 * @return $this
	 */
	public function setFilePath(string $fileName): self
	{
		$this->fileName = new File($fileName);
		return $this;
	}

	/**
	 * @return array
	 */
	public function count(): array
	{
		$this->setText($this->fileName->getContent());

		$words = $this->split();

		$result = [];
		foreach ($words as $word) {
			if(!isset($result[$word])) {
				$result[$word] = 0;
			}
			$result[$word] += 1;
		}

		return $this->sort($result);
	}

	/**
	 * @param array $amountOfWords
	 * @return array
	 */
	private function sort(array $amountOfWords)
	{
		$sort = new Sort($amountOfWords);
		return $sort->execute();
	}

	/**
	 * @return array
	 */
	private function split(): array
	{
		return preg_split(
			'/[\s]/',
			$this->text,
			null,
			PREG_SPLIT_NO_EMPTY
		);
	}
}