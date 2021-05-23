<?php
declare(strict_types=1);

namespace App\Storage;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

/**
 * Class ElasticSearchClient
 * @package App\Lib
 */
abstract class ElasticSearchClient
{
    protected Client $client;

    public function __construct(string $host)
    {
        // @todo: fix hard code
        $hosts = [$host];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function isIndexExist(string $param): bool
    {
        $indexParams['index'] = $param;
        return $this->client->indices()->exists($indexParams);
    }

    public function search(\DateTime $date, string $station, string $equipment): callable|array
    {
        $params = [
            'index' => static::INDEX,
            'body' => [
                'query' =>
                    [
                        'bool' => [
                            'must' => [
                                ['match' => ['date' => $date->format('Y-m-d')]],
                                ['match' => ['station' => $station]],
                                ['match' => ['equipment.name' => $equipment]]
                            ]
                        ]
                    ]
            ]
        ];
        return $this->client->search($params);
    }

    public function searchAll(): callable|array
    {
        $params = [
            'index' => static::INDEX,
            'body' => [
                'sort' =>
                    [
                        'date' => ["order" => "asc"]
                    ]
            ]
        ];
        return $this->client->search($params);
    }

    public function removeIndex(): void
    {
        $deleteParams = [
            'index' => static::INDEX
        ];
        $this->client->indices()->delete($deleteParams);
    }

    public function remove(string $id): void
    {
        $params = [
            'index' => static::INDEX,
            'id' => $id
        ];
        $this->client->delete($params);
    }

    public function populate(array $data, string $id = ''): void
    {
        if (!empty($id)) {
            $params = [
                'index' => static::INDEX,
                'id' => $id,
                'body' => [
                    'doc' => $data
                ]
            ];
            $this->client->update($params);
        } else {
            $params = [
                'index' => static::INDEX,
                'body' => $data
            ];
            $this->client->index($params);
        }
    }
}
