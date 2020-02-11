<?php
/**
 * Created by Vitaliy Prokhonenkov <prokhonenkov@gmail.com>
 * Date 10.02.2020
 * Time 18:37
 */

namespace prokhonenkov\wordcounter;


class Sort
{
	/**
	 * @var array
	 */
	private $amountOfWords;

	/**
	 * Sort constructor.
	 * @param array $amountOfWords
	 * ...php
	 *     $amountOfWords = [
	 *         "oneWord" => 2,
	 *         "twoWord" => 2,
	 *         "threeWord" => 1,
	 *         "fourWord" => 1
	 *     ]
	 * ...
	 */
	public function __construct(array $amountOfWords)
	{
		$this->amountOfWords = $amountOfWords;
	}

	/**
	 * @param array $someArray
	 * @return array
	 */
	private function sortByValue(array $someArray): array
	{
		arsort($someArray, SORT_NUMERIC);
		return $someArray;
	}

	/**
	 * @param array $someArray
	 * @return array
	 */
	private function sortByKey(array $someArray): array
	{
		ksort($someArray, SORT_STRING);
		return $someArray;
	}

	/**+
	 * @return array
	 */
	public function execute(): array
	{
		$result = $this->sortByValue($this->amountOfWords);

		$i = 0;
		$arraySlice = [];
		$sorted = [];
		$flag = current($result);;

		foreach ($result as $word => $amount) {
			if($flag !== $amount) {
				$sorted = array_merge($sorted, $this->sortByKey($arraySlice[$i]));
				$i++;
			}
			$arraySlice[$i][$word] = array_shift($result);
			$flag = $amount;

		}

		$sorted = array_merge($sorted, $this->sortByKey($arraySlice[$i]));

		return $sorted;
	}
}