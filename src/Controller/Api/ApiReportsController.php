<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Storage\EquipmentElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ReportsController
 * @package App\Api\Controller
 */
class ApiReportsController extends AbstractController
{
    public function __construct(private EquipmentElasticSearch $elasticSearchClient)
    {
    }

    #[Route('/api/report', name: 'api-report', methods: ['GET'])]
    public function index(): Response
    {
        $data = $this->elasticSearchClient->searchAll();
        if (empty($data)) {
            return $this->json([]);
        }
        return $this->json($data['hits']['hits']);
    }
}
