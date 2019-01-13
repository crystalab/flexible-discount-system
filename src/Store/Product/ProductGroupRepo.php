<?php

namespace App\Store\Product;

use Doctrine\ORM\EntityRepository;

class ProductGroupRepo extends EntityRepository
{
    public function getProductIdToGroupsMap(array $productIds): array
    {
        assert(!empty($productIds));

        $qb = $this->createQueryBuilder("product_group");
        $qb->join("product_group.products", "product")
            ->where($qb->expr()->in("product.id", $productIds));

        /** @var ProductGroup[] $productGroups */
        $productGroups = $qb->getQuery()->getResult();

        $result = [];
        foreach ($productGroups as $productGroup) {
            foreach ($productGroup->getProducts() as $product) {
                $result[$product->getId()][] = $productGroup;
            }
        }

        return $result;
    }
}
