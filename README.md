# Conciergerie

Bienvenue dans ce projet conciergerie

Programmé en php orienté objet ainsi que l'utilisation de Bootstrap 5
Ce projet est pour moi l'occasion de découvrir le POO et les MVC (Model-View-Controller) et les mettre en pratique. Il est destiné à évoluer avec le temps afin de proposer un site le plus complet possible.
-> DashBoard pour les admins (concierges, propriétaires etc...) > Dispo pour l'instant : CRUD des tâches du concierge
->Annonces pour les résidents (aide, vente etc..) > à développer
->Actualité de la vie locale > à développer
->Location/vente des biens immobiliers > ) développer

> Programmed in object oriented php as well as using Bootstrap 5 This
> project is an opportunity for me to discover OOP and MVC
> (Model-View-Controller) and put them into practice. It is intended to
> evolve over time in order to offer the most complete site possible.
> -> DashBoard for admins (janitors, owners etc...) > Available for now: CRUD for concierge tasks
> -> Announcements for residents (help, sale etc.) > to be developed
> ->News of local life > to be developed
> -> Rental / sale of real estate > to be developed

## Prérequis:
Il est nécessaire d'avoir Wamp,Xamp,Mamp,Laragon pour lancer ce projet. Ainsi qu'une base de donnée en SQL
Le fichier index étant dans un dossier "public", il est impératif à la création de votre "localhost" d'indiquer le chemin où est situé projet > public > index.php

> It is necessary to have Wamp, Xamp, Mamp, Laragon to launch this
> project. As well as a database in SQL The index file being in a
> "public" folder, it is imperative when creating your "localhost" to
> indicate the path where project > public > index.php is located

## Base de données

Pour ce projet vous aurez besoin d'une base de données "**concierge**" avec deux tables

> For this project you will need a "**concierge**" database with two
> tables

1ère table : "**taches**"
| id| date  | type_tache | desc_tache | appart | etage | resident_id
|-----|-------|---------------|--------------|---------|--------|--------------|
|1  | 2022-08-30 | reparation | radiateur defectueux | 2 | 7 | 5

**************************
2nd table : "**users**" 
| id| email| password | roles|
|---|-------|------------|---|
|1  | test@test.com | t=4,p=1$qjDzfTtaKZw| ["ROLE_ADMIN"]|
|1  | toto@test.com | dsfgsr$sd*djDzfTtaKZw| | null
roles est un JSON. Il peut avoir la valeur Null, par défaut son rôle sera celui d'un "user normal"
Pour accéder à la partie Admin du site, vous aurez besoin d'un user enregistré en tant que "**ROLE_ADMIN**"

> roles is JSON. It can have the value Null, by default its role will be
> that of a "normal user" To access the Admin part of the site, you will
> need a user registered as "**ROLE_ADMIN**"

```


