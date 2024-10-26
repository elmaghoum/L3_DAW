# Projet de Site Web de Formation

## Contexte

Aujourd'hui, avec la multiplication de la technologie, le développement web est devenu un secteur en constante évolution. Il est crucial de maîtriser les bases et de se tenir informé des dernières tendances et technologies. La création d'un site web de formation dans ce domaine nous semble passionnante et prometteuse. Pour orienter notre projet, nous avons pris comme référence des sites de formation existants tels qu'OpenClassroom, W3Schools, Codecademy, Udemy, Coursera...

Ce projet a été réalisé par des étudiants en Licence 3 Informatique dans le cadre du module Développement d'Applications WEB (DAW). Ce travail est un projet de fin de cursus visant à mettre en pratique les connaissances acquises au cours de l'année.

## Objectif

L'objectif de notre site web de formation est de fournir une plateforme pour apprendre et actualiser ses connaissances sur le développement d'applications web.

## Fonctionnalités

L'application sera composée de deux parties :

### Partie Administrateur

- Chargement des cours sous forme de diapositives, vidéos, etc.
- Gestion des utilisateurs (création, modification, suppression).
- Gestion des QCM pour évaluer les utilisateurs sur leurs connaissances.

### Partie Apprenant/Utilisateur

- Gestion de l'espace personnel.
- Gestion des cours.
- Construction du profil de l'apprenant : des QCM sont proposés afin de définir le niveau de l'apprenant et de lui proposer des cours adaptés.
- Recommandation de cours.
- Forum de discussion entre les apprenants.

## Consignes Techniques

- Travail en mode projet avec les membres du groupe (méthode AGILE).
- Utilisation d'une architecture MVC.
- Utilisation des sessions / cookies.
- Les QCM sont traités en format XML.
- Le site comportera 2 thèmes graphiques définis par 2 feuilles de style CSS (clair et sombre).
- REMARQUE : Utilisation uniquement des outils vus en cours, il est interdit d’utiliser Bootstrap ou un autre framework. La mise en forme devra être faite à la main en HTML5/CSS3/JavaScript.

## Partie AGILE

Ce projet a été un défi, car nous ne connaissions que peu nos camarades. Cependant, après de nombreuses réunions, nous avons réussi à nous organiser, à identifier les forces et faiblesses de chacun, et à répartir le travail efficacement. Pour respecter la méthode agile et garantir le succès du projet, nous avons créé un Trello (outil de gestion de projet en ligne) pour mieux gérer les différentes tâches. Nous avons également utilisé GitHub pour le dépôt de code.

Nous avons profité de nos réunions pour discuter des divergences d'opinion sur certaines parties du projet, par exemple :

- Qu'est-ce qu'un cours ? Un chapitre ?
- Comment évalue-t-on un QCM ? Sur 10 points ? 20 points ?
- À partir de quand un cours est-il considéré comme appris ? Lien avec les QCM ?
- Comment fonctionne la recommandation d’un cours ? Système de tag ?
- Comment ajouter un apprenant ? Possibilité de créer un compte ou ajout manuel par l'admin ?

## La Base de Données

La création d'une base de données est cruciale dans la conception d'un site web dynamique. Pour créer notre base de données, nous avons utilisé l’outil PhpMyAdmin. Voici les étapes suivies :

1. Connexion à PhpMyAdmin en accédant à l'URL correspondante sur notre serveur web.
2. Dans l'onglet "Bases de données", création d'une nouvelle base de données avec un nom et d'autres paramètres (comme l'encodage).
3. Création des tables nécessaires pour notre site en cliquant sur l'onglet "Nouvelle table" et en ajoutant les champs nécessaires.
   - Exemple de la table `USERS` :
     - Identifiant
     - Nom
     - Prénom
     - Adresse mail
     - Mot de passe
     - Rôle (apprenant ou admin)
     - URL de la photo de profil
     - Tag

Un total de 8 tables ont été créées : `USERS`, `COURS`, `CHAPITRE`, `INSCRIPTION`, `QCM`, `NOTE`, `POST` et `RESPONSE`.

## Gestion des QCM

La gestion des QCM (Questionnaires à Choix Multiples) est une fonctionnalité essentielle de notre site. Voici les étapes pour gérer les QCM :

1. Création d'un fichier XML pour stocker les questions et les réponses possibles.
2. Utilisation d'une fonction PHP pour lire les données du fichier XML et les afficher sous forme de formulaire sur le site.
3. Validation des réponses des utilisateurs via un script PHP qui compare les réponses sélectionnées avec celles du fichier XML.
4. Affichage du résultat final de l'évaluation du QCM à l'utilisateur. Selon ses réponses, l’apprenant peut valider le cours qu’il suit.

## REMARQUE
- Réaliser des tests de sécurité pour nous assurer que le site est sécurisé contre les attaques et les vulnérabilités potentielles. Nous avons utilisé notre culture générale et des outils de test de sécurité pour détecter les vulnérabilités et les failles de sécurité dans le site. 

- Nos données “fragiles” sont les données utilisateurs (nom, prénom, adresse e-mail et mot de passe). Il est donc important pour nous de mettre des outils et des techniques en œuvre pour bien gérer la confidentialité des données. La sécurité des données n’est pas une spécification requise par le sujet, mais il s’agit pour nous d’un élément supplémentaire que nous souhaitions implémenter (et qui peut compenser pour ce qui n'a pas été fait).

- Les password (mots de passe) sont hashés en sha1, et sont stockés directement dans la base de données.
  
- Bien que ce projet peut être considéré comme un peu vieillot, car il a été réalisé strictement en HTML5, CSS, JS, PHP (sans framework) il représente une opportunité d'apprentissage pour tous les membres de l'équipe, en nous permettant de mettre en pratique nos compétences "élémentaire" de développement web et en gestion de projet agile.
  
## Conclusion

En conclusion, nous avons réussi à créer une plateforme fonctionnelle et facile à utiliser pour apprendre et actualiser nos connaissances sur le développement web d'applications. Toutefois, il est important de continuer à améliorer le site web pour répondre aux besoins des apprenants et des administrateurs. Dans cette optique, nous avons identifié quelques suggestions d'amélioration qui pourraient être utiles pour optimiser la qualité de notre site de formation, par exemple :

- Ajouter des fonctionnalités pour permettre aux apprenants de noter les cours et d'évaluer la qualité de l'enseignement. Cela pourrait aider les futurs apprenants à décider s'ils veulent suivre ce cours ou non.
- Offrir plus de personnalisation pour la présentation graphique du site en proposant des options pour les couleurs, les polices et les images d'arrière-plan.
- Optimiser les performances du site en minimisant les requêtes de base de données et en utilisant des techniques de cache pour améliorer la vitesse de chargement des pages.
- Etc.

Bien que certaines fonctionnalités n’aient pas été implémentées faute de temps ou de connaissance, nous avons acquis de précieuses compétences en travaillant ensemble sur ce projet comme le sérieux, la rigueur, le travail d'équipe ou encore la communication, la gestion du temps, l’organisation et bien d’autres. 

Grâce à ce projet de fin de cursus, nous avons pu nous glisser dans les chaussures de développeurs WEB aguerris et avoir un aperçu du monde du travail.



## AUTEUR
JORGE ALEXANDRE
EL MAGHOUM FAYCAL
REBAH EL MEHDI
MEZIANE RAYENE
AZDAD MOHAMED
GENCE ELIO
