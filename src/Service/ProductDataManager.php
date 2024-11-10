<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class ProductDataManager
{
    private $projectDir;
    private $products;

    public function __construct(KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
        $this->loadProducts();
    }

    private function loadProducts()
    {
        $filePath = $this->projectDir . '/src/DataFixtures/products.json';
        $jsonData = file_get_contents($filePath);
        $this->products = json_decode($jsonData, true);
    }

    private function saveProducts()
    {
        $filePath = $this->projectDir . '/src/DataFixtures/products.json';
        $jsonData = json_encode($this->products, JSON_PRETTY_PRINT);
        file_put_contents($filePath, $jsonData);
    }

    public function getAllProducts()
    {
        return $this->products;
    }

    public function getProductById($id)
    {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }
        return null;
    }

    public function createProduct($productData)
    {
        $productData['id'] = count($this->products) + 1;
        $this->products[] = $productData;
        $this->saveProducts();
    }

    public function updateProduct($id, $productData)
    {
        foreach ($this->products as &$product) {
            if ($product['id'] == $id) {
                $product = array_merge($product, $productData);
                $this->saveProducts();
                return true;
            }
        }
        return false;
    }

    public function deleteProduct($id)
    {
        foreach ($this->products as $key => $product) {
            if ($product['id'] == $id) {
                unset($this->products[$key]);
                $this->saveProducts();
                return true;
            }
        }
        return false;
    }
}