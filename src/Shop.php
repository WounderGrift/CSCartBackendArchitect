<?php

declare(strict_types=1);

namespace Shop;

final class Shop
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        $pricelessStuff = [
            'Blue cheese', 'Concert tickets', 'Mjolnir'
        ];
        
        foreach ($this->items as $item)
        {
            if (!in_array($item->name, $pricelessStuff) && $item->quality > 0)
                $item->quality--;
            else if ($item->quality < 50)
            {
                $item->quality++;
                if ($item->name == 'Concert tickets' && $item->quality < 50)
                {
                    if ($item->sell_in < 11)
                        $item->quality++;
                    if ($item->sell_in < 6)
                        $item->quality++;
                }
            }

            if ($item->name != 'Mjolnir')
                $item->sell_in--;
    
            if ($item->sell_in >= 0)
                continue;
    
            if ($item->name == 'Blue cheese')
            {
                if ($item->quality < 50)
                    $item->quality++;
            }
            else if ($item->name == 'Concert tickets')
                $item->quality = 0;
            else if ($item->quality > 0 && $item->name != 'Mjolnir')
                $item->quality--;
        }
    }
}