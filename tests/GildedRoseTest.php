<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\GildedRose;
use App\Item;

class GildedRoseTest extends TestCase
{

	public function test_Some_Item_Decrease_Quality_in_1_unit()
	{
		$someItem = new Item("Some Item", 2, 3);

		GildedRose::updateQuality([$someItem]);

		$this->assertEquals(2, $someItem->quality);
		$this->assertEquals(1, $someItem->sellIn);
	}

	public function test_sellIn_passed_quality_decrease_doble()
	{
		$someItem = new Item("Some Item", 0, 3);

		GildedRose::updateQuality([$someItem]);

		$this->assertEquals(1, $someItem->quality);
	}


	public function test_quality_item_never_under_0()
	{
		$someItem = new Item("Some Item", 2, 0);

		GildedRose::updateQuality([$someItem]);

		$this->assertEquals(0, $someItem->quality);
	}

	public function test_agedbrie_increase_quality()
	{
		$agedbrie = new Item("Aged Brie", 2, 0);

		GildedRose::updateQuality([$agedbrie]);

		$this->assertEquals(1, $agedbrie->quality);
	}

	public function test_if_quality_never_bigger_then_50()
	{
		$agedbrie = new Item("Aged Brie", 2, 50);

		GildedRose::updateQuality([$agedbrie]);

		$this->assertEquals(50, $agedbrie->quality);
	}

	public function test_Sulfuras_never_sell_never_decrease_quality()
	{
		$sulfuras = new Item("Sulfuras, Hand of Ragnaros", 1, 1);

		GildedRose::updateQuality([$sulfuras]);

		$this->assertEquals(1, $sulfuras->quality);
		$this->assertEquals(1, $sulfuras->sellIn);
	}

	public function test_backstage_increment_quality_above_10()
	{
		$backstage = new Item("Backstage passes to a TAFKAL80ETC concert", 11, 1);

		GildedRose::updateQuality([$backstage]);

		$this->assertEquals(2, $backstage->quality);
	}

	public function test_backstage_increment_double_quality_under_or_equals_10()
	{
		$backstage = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 1);

		GildedRose::updateQuality([$backstage]);

		$this->assertEquals(3, $backstage->quality);
	}

	public function test_backstage_increment_triple_quality_under_or_equals_5()
	{
		$backstage = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 1);

		GildedRose::updateQuality([$backstage]);

		$this->assertEquals(4, $backstage->quality);
	}

	public function test_backstage_decrease_to_0_after_concert()
	{
		$backstage = new Item("Backstage passes to a TAFKAL80ETC concert", 0, 1);

		GildedRose::updateQuality([$backstage]);

		$this->assertEquals(0, $backstage->quality);
	}
	
}