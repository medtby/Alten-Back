<?php

namespace App\Controller;

use App\Service\ProductDataManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/products')]
class ProductController extends AbstractController
{
    private $productDataManager;

    public function __construct(ProductDataManager $productDataManager)
    {
        $this->productDataManager = $productDataManager;
    }

    #[Route('', name: 'get_all_products', methods: ['GET'])]
    public function getAllProducts(): JsonResponse
    {
        $products = $this->productDataManager->getAllProducts();
        return $this->json($products);
    }

    #[Route('/{id}', name: 'get_product', methods: ['GET'])]
    public function getProduct($id): JsonResponse
    {
        $product = $this->productDataManager->getProductById($id);
        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }
        return $this->json($product);
    }

    #[Route('', name: 'create_product', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $productData = json_decode($request->getContent(), true);
        $this->productDataManager->createProduct($productData);
        return $this->json(['message' => 'Product created successfully']);
    }

    #[Route('/{id}', name: 'update_product', methods: ['PUT', 'PATCH'])]
    public function updateProduct($id, Request $request): JsonResponse
    {
        $productData = json_decode($request->getContent(), true);
        $success = $this->productDataManager->updateProduct($id, $productData);
        if (!$success) {
            return $this->json(['error' => 'Product not found'], 404);
        }
        return $this->json(['message' => 'Product updated successfully']);
    }

    #[Route('/{id}', name: 'delete_product', methods: ['DELETE'])]
    public function deleteProduct($id): JsonResponse
    {
        $success = $this->productDataManager->deleteProduct($id);
        if (!$success) {
            return $this->json(['error' => 'Product not found'], 404);
        }
        return $this->json(['message' => 'Product deleted successfully']);
    }
}