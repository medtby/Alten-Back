# API de gestion des produits - Partie backend

Ce projet est une API RESTful développée avec Symfony pour gérer les opérations CRUD sur des produits. L'API utilise un fichier JSON comme source de données pour stocker les informations des produits.

## Prérequis

- PHP
- Composer
- Symfony CLI

## Installation

1. Clonez ce dépôt de code source sur votre machine locale.

2. Accédez au répertoire du projet.
cd product-trial-master/back

3. Installez les dépendances du projet à l'aide de Composer.
composer install

## Structure du projet

- `src/Controller/ProductController.php` : Contrôleur qui gère les routes de l'API et les opérations CRUD sur les produits.
- `src/Service/ProductDataManager.php` : Service qui gère les opérations de lecture et d'écriture sur le fichier JSON des produits.
- `src/DataFixtures/products.json` : Fichier JSON contenant les données des produits.
