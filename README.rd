# Kevinitator de PDF

## Description
Kevinitator de PDF est une application web basée sur Symfony et Twig qui permet de générer des fichiers PDF à partir d'URLs. Elle intègre Gotenberg pour la conversion et la gestion des documents. L'application propose un système de gestion de profils avec authentification basée sur un token stocké en local et enregistré dans une base de données MySQL.

## Fonctionnalités principales
- **Génération de PDF** : Création et gestion de liens URL pointant vers un fichier PDF.
- **Contrôleurs spécifiques** : Chaque page dispose de son propre contrôleur pour la génération des PDF.
- **Interface utilisateur attrayante** : Utilisation de Twig avec une mise en forme colorée, des boutons orange pour une harmonie visuelle sobre.
- **Gestion des utilisateurs** :
  - Inscription et connexion avec stockage des informations en base de données MySQL.
  - Gestion des sessions à l'aide d'un token stocké en local.
  - Possibilité de se déconnecter.
- **Système d'abonnement** :
  - Historique des fichiers générés.
  - Limitation du nombre de fichiers PDF créés en fonction du type d'abonnement choisi.
  - Possibilité de changer facilement d'abonnement.

## Technologies utilisées
- **Symfony** : Framework PHP pour le backend.
- **Twig** : Moteur de templates pour une interface dynamique.
- **Gotenberg** : Service pour la conversion et la génération de PDF.
- **MySQL** : Base de données pour stocker les informations des utilisateurs et des fichiers.
- **Bootstrap/Tailwind CSS** : (Optionnel) Pour le stylisme et l'interface utilisateur.

## Installation
### Prérequis
- PHP 8+
- Composer
- Symfony CLI
- MySQL
- Docker (pour Gotenberg)

## Utilisation
- **Accéder à l'application** : `http://localhost:8000`
- **S'inscrire et se connecter**
- **Générer un PDF à partir d'une URL**
- **Gérer son historique et ses abonnements**

## Contributions
Les contributions sont les bienvenues !
1. Forker le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature-nouvelle-fonction`)
3. Soumettre une pull request
