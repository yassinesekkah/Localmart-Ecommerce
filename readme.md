
# LocalMart - Application Web E-Commerce Monolithique

## Description

LocalMart est une application web e-commerce monolithique développée avec Laravel.
Elle permet aux vendeurs de proposer leurs produits en ligne et aux clients de consulter le catalogue, passer des commandes, interagir avec les produits et suivre leurs statuts.

Le projet met en œuvre une architecture Laravel scalable avec gestion avancée des rôles, permissions, policies et notifications.

---

## Technologies Utilisées

* PHP 
* Laravel 
* MySQL
* HTML5 / CSS / Tailwind CSS
* Livewire
* Git & GitHub
* Laravel Breeze (Authentification)
* Spatie Laravel Permission (Gestion des rôles et permissions)
* Mailtrap (Emails en développement)

---

## Architecture

Application monolithique Laravel basée sur :

* Architecture MVC
* Middlewares
* Policies
* Notifications
* Relations Eloquent avancées
* Gestion multi-rôles

---

## Rôles Utilisateurs

* Client
* Seller
* Admin
* Moderator

Gestion des rôles via le package Spatie Laravel Permission.

---

## Fonctionnalités

### Authentification & Autorisation

* Inscription et connexion avec Laravel Breeze
* Gestion des rôles
* Protection des routes via middleware
* Autorisations via Policies

### Boutique en Ligne

* Catalogue de produits par catégories
* Page détail produit (description, prix, stock, avis)
* Gestion des stocks en temps réel
* Système de likes
* Système de notation et avis

### Panier & Commandes

* Ajout et suppression de produits au panier
* Validation de commande
* Suivi du statut :

  * En attente
  * Payée
  * Livrée

### Notifications Email

* Notification lors d’une nouvelle commande
* Notification lors d’un changement de statut
* Notification lors d’un nouvel avis

Envoi via Gmail ou Mailtrap.

### Paiement en Ligne (Bonus)

* Intégration Stripe
* Gestion du statut de paiement
* Utilisation des webhooks


## Déploiement

Application déployée sur Render avec :

* Configuration des variables d’environnement
* Base de données MySQL
* Migrations exécutées en production

---

## Sécurité

* Protection CSRF
* Validation des formulaires
* Policies pour contrôle d’accès
* Middleware pour gestion des rôles

---

## Compétences Mobilisées

* Développement web avec Laravel
* Architecture MVC
* Gestion des rôles et permissions
* Notifications et emails
* Git versioning
* Déploiement cloud

