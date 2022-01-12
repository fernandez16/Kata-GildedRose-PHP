<?php

declare(strict_types=1);

namespace App;

class GildedRose
{

    private $backstagePass = "Backstage passes to a TAFKAL80ETC concert";
    private $sulfuras = "Sulfuras, Hand of Ragnaros";
    private $agedbrie = "Aged Brie";
    private $conjured = "Conjured";

    public static function updateQuality($items)
    {
        for ($i = 0; $i < count($items); $i++) {
            if (("Aged Brie" != $items[$i]->getName()) && (GildedRose::getBackstagePass() != $items[$i]->getName())) {
                if ($items[$i]->getQuality() > 0) {
                    if (GildedRose::isRagnaros($items, $i)) {
                        $items[$i]->setQuality($items[$i]->getQuality() - 1);
                    }
                }
            } else {
                if (GildedRose::qualityIsLowerThan50($items, $i)) {
                    GildedRose::addValue($items, $i, +1);
                    if ($backstagePass == $items[$i]->getName()) {
                        if ($items[$i]->getSellIn() < 11) {
                            if (GildedRose::qualityIsLowerThan50($items, $i)) {
                                GildedRose::addValue($items, $i, +1);
                            }
                        }
                        if ($items[$i]->getSellIn() < 6) {
                            if (GildedRose::qualityIsLowerThan50($items, $i)) {
                                GildedRose::addValue($items, $i, +1);
                            }
                        }
                    }
                }
            }

            if (GildedRose::isRagnaros($items, $i)) {
                $items[$i]->setSellIn($items[$i]->getSellIn() - 1);
            }

            if ($items[$i]->getSellIn() < 0) {
                if ("Aged Brie" != $items[$i]->getName()) {
                    if ($backstagePass != $items[$i]->getName()) {
                        if ($items[$i]->getQuality() > 0) {
                            if (GildedRose::isRagnaros($items, $i)) {
                                $items[$i]->setQuality($items[$i]->getQuality() - 1);
                            }
                        }
                    } else {
                        GildedRose::addValue($items, $i, -($items[$i]->getQuality()));
                    }
                } else {
                    if (GildedRose::qualityIsLowerThan50($items, $i)) {
                        GildedRose::addValue($items, $i, +1);
                    }
                }
            }
        }
    }

    public static function isRagnaros($items, $i) {
        return ("Sulfuras, Hand of Ragnaros" != $items[$i]->getName());
    }

    public static function qualityIsLowerThan50($items, $i) {
        return ($items[$i]->getQuality() < 50);
    }

    public static function addValue($items, $i, $valueAdded) {
        $items[$i]->setQuality($items[$i]->getQuality("asdf") + $valueAdded);
    }
}
