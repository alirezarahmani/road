<?php
declare(strict_types=1);

namespace App\Controller;

use App\Storage\EquipmentElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    public function __construct(private EquipmentElasticSearch $elasticSearchClient)
    {
    }

    #[Route('/report', name: 'report', methods: ['GET'])]
    public function index(): Response
    {
        $data = $this->elasticSearchClient->searchAll();
        return $this->render('report/index.html.twig', [
            'data' => $data['hits']['hits']
        ]);
    }
}
