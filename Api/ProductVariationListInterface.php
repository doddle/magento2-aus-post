<?php
namespace AustraliaPost\Returns\Api;

interface ProductVariationListInterface
{
    /**
     * Retrieve information about sibling variants of a configurable product's child sku
     *
     * @param string $sku
     * @return \AustraliaPost\Returns\Api\Data\Product\VariationInterface[]
     */
    public function getItems($sku);
}
