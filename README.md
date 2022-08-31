
# Conciergerie

Bienvenue dans ce projet conciergerie

Programmé en php orienté objet + Bootstrap 5
Ce projet est pour moi l'occasion de découvrir le POO et les MVC (Model-View-Controller) et les mettre en pratique. Il est destiné à évoluer avec le temps afin de proposer un site le plus complet possible.
-> DashBoard pour les admins (concierges, propriétaires etc...) > Dispo pour l'instant : CRUD des tâches du concierge
->Annonces pour les résidents (aide, vente etc..) > à développer
->Actualité de la vie locale > à développer
->Location/vente des biens immobiliers > ) développer

> Programmed in object oriented php + Bootstrap 5 This
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

> It is necessary to have Wamp, Lamp, Mamp, Laragon to launch this
> project. As well as a database in SQL The index file being in a
> "public" folder, it is imperative when creating your "localhost" to
> indicate the path where project > public > index.php is located

## Base de données

Pour ce projet vous aurez besoin d'une base de données "**concierge**" avec deux tables

> For this project you will need a "**concierge**" database with three
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
|1  | toto@test.com | dsfgsr$sd*djDzfTtaKZw| | null|
****************************

3e table : "**annonces**" 
| id| titre | description | created_at| users_id
|---|-------|------------|---|------|
|1  | je suis un titre| je suis une descrpition | 2022-08-30 | 5 |

****************************

roles est un JSON. Il peut avoir la valeur Null, par défaut son rôle sera celui d'un "user normal"
Pour accéder à la partie Admin du site, vous aurez besoin d'un user enregistré en tant que "**ROLE_ADMIN**"

> roles is JSON. It can have the value Null, by default its role will be
> that of a "normal user" To access the Admin part of the site, you will
> need a user registered as "**ROLE_ADMIN**"

******************

Ce projet a été réalisé à l'aide des tutos de [Nouvelle-Techno.fr](https://github.com/NouvelleTechno) sur le POO
Nous avons dans ce projet utilisé : 

Les **espaces de nom (namespace)** permettent d'attribuer "**virtuellement**" des dossiers à nos classes.

Un **autoloader** où nous allons mettre en place un **système de chargement des fichiers à la demande**.
En résumé, si le serveur PHP trouve une classe qu'il ne connaît pas, il va chercher le fichier correspondant et le charger pour nous.

un **formBuilder** nous permettant de générer des formulaires en lui indiquant valeur.e.s et paramètre.s

Une structure **MVC** : 

> This project was carried out using tutorials from
> [Nouvelle-Techno.fr](https://github.com/NouvelleTechno) on the OOP In
> this project we used:
> The **namespaces** make it possible to "**virtually**" assign folders
> to our classes.
> An **autoloader** where we will set up an **on-demand file loading
> system**. In summary, if the PHP server finds a class that it does not
> know, it will look for the corresponding file and load it for us.
> a **formBuilder** allowing us to generate forms by indicating value.e.s and parameter.s
> A **MVC** system:

![description du MVC](https://nouvelle-techno.fr/assets/uploads/content/a16f52e9a52a87b3c68065c4dd2d470a.jpg)
*******

Pour m'aider à la programmation j'ai utilisé les extensions VSCode me permettant d'intégrer les setters et getters à l'aide d'un clic droit. Comme [Php-getters-setters](https://marketplace.visualstudio.com/items?itemName=phproberto.vscode-php-getters-setters)
Ainsi que Bootsrap, pour facilité le 'front' pour la mise en forme des tableaux et formulaires

> To help me with programming I used VSCode extensions allowing me to
> integrate setters and getters using a right click. Like
> [php-getters-setters](https://marketplace.visualstudio.com/items?itemName=phproberto.vscode-php-getters-setters)
> As well as Bootsrap, so I have focus more on the "back" side  than the "front"

