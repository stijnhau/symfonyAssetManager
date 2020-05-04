<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\AssetType;
use App\Entity\MarketingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $assetTypes = $this->getDoctrine()
            ->getRepository(AssetType::class)
            ->findAll();
        $marketingTypes = $this->getDoctrine()
            ->getRepository(MarketingType::class)
            ->findAll();

        $dql = "SELECT
                    DISTINCT location,
                    id,
                    game_id
                from asset
                    RIGHT JOIN asset_asset_type on asset.id=asset_asset_type.asset_id
                    RIGHT JOIN asset_marketing_type on asset.id=asset_marketing_type.asset_id
                WHERE (1 =1)";

        $marketingType = ($request->query->get('marketing_type'));
        if ($marketingType !== null) {
            $marketingTypeArr = explode(',', $marketingType);
            $marketingTypeArr = array_keys(array_intersect(array_count_values($marketingTypeArr),[1]));
            $marketingType = implode($marketingTypeArr, ',');
            if ($marketingType !== '') {
                // @todo sql injection
                $dql .= " AND asset_marketing_type.marketing_type_id in (" . ltrim($marketingType, ',') . ")";
            }
        }

        $assetType = ($request->query->get('asset_type'));
        if ($assetType !== null) {
            $assetTypeArr = explode(',', $assetType);
            $assetTypeArr = array_keys(array_intersect(array_count_values($assetTypeArr),[1]));
            $assetType = implode($assetTypeArr, ',');
            if ($assetType !== '') {
                // @todo sql injection
                $dql .= " AND asset_asset_type.asset_type_id in (" . ltrim($assetType, ',') . ")";
            }
        }

        $dql .= "ORDER BY asset.id DESC";
        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($dql);
        $statement->execute();

        $assetsObj = $statement->fetchAll();
        $assets = array();
        foreach ($assetsObj as $asset) {
            $assetObj = $this->getDoctrine()
                ->getRepository(Asset::class)
                ->findOneBy(array('id' => $asset['id']));
            $assets[] = $assetObj;
        }

        return $this->render('list/index.html.twig', [
            'assetTypes' => $assetTypes,
            'marketingTypes' => $marketingTypes,
            'assetType' => $assetType,
            'marketingType' => $marketingType,
            'assets' => $assets,
        ]);
    }
}
