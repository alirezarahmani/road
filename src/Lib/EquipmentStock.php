<?php
declare(strict_types=1);

namespace App\Lib;

use App\Domain\Equipment;
use App\Domain\Station;
use App\Storage\StorageInterface;

/**
 * Class EquipmentStock
 * @package App\Lib
 */
class EquipmentStock
{
    /**
     * EquipmentStock constructor.
     * @param StorageInterface $storage
     * @param Equipment $equipment
     * @param int $amount
     */
    public function __construct(
        private StorageInterface $storage,
        private Equipment $equipment,
        private int $amount
    ) {
    }

    /**
     * @param Station $station
     * @param \DateTimeInterface $date
     * @param int $countAll
     */
    public function increase(Station $station, \DateTimeInterface $date, int $countAll): void
    {
        $this->modifyStockCache($station, $date, $countAll, function ($a, $b) {
            return $a + $b;
        });
    }

    /**
     * @param Station $station
     * @param \DateTimeInterface $date
     * @param int $countAll
     */
    public function decrease(Station $station, \DateTimeInterface $date, int $countAll): void
    {
        $this->modifyStockCache($station, $date, $countAll, function ($a, $b) {
            return $a - $b;
        });
    }

    /**
     * @param Station $station
     * @param \DateTimeInterface $date
     * @param int $countAll
     * @param callable $calculate
     */
    private function modifyStockCache(
        Station $station,
        \DateTimeInterface $date,
        int $countAll,
        callable $calculate
    ): void {
//        $results = $this->storage->searchAll();
//
//        foreach ($results['hits']['hits'] as $r)
//        {
//            $this->storage->remove($r['_id']);exit;
//        }
//        exit;

        $result = $this->storage->search($date, $station->getName(), $this->equipment->getName());
        if (isset($result['hits']['hits']) && count($result['hits']['hits']) > 0) {
            $source = $result['hits']['hits'][0]['_source'];
            $this->save(
                $date->format('Y-m-d'),
                $station->getName(),
                $this->equipment->getName(),
                $calculate(
                    $source['equipment']['count'],
                    $this->amount
                ),
                $result['hits']['hits'][0]['_id']
            );
        } else {
            $this->save(
                $date->format('Y-m-d'),
                $station->getName(),
                $this->equipment->getName(),
                $calculate($countAll, $this->amount)
            );
        }
    }

    /**
     * @param mixed ...$arg
     */
    private function save(mixed ...$arg): void
    {
        $item = [
            'date' => $arg[0],
            'station' => $arg[1],
            'equipment' => [
                'name' => $arg[2],
                'count' => $arg[3]
            ]
        ];
        $this->storage->populate($item, isset($arg[4]) ? $arg[4] : '');
    }
}
