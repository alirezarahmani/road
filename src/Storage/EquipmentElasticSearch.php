<?php
declare(strict_types=1);

namespace App\Storage;

/**
 * Class EquipmentElasticSearch
 * @package App\Storage
 */
class EquipmentElasticSearch extends ElasticSearchClient implements StorageInterface
{
    public const INDEX = 'equipments_stock';
}
