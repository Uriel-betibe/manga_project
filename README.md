# manga_project
site d'application des bases en PHP et communication entre le site web et la base de donnée 

PROJET SAMBIANI URIEL TECHNO WEB 

Pour la réalisation de mon projet j’ai utilisé : 
-	HTML5
-	CSS
-	JS
-	BOOTSTRAP 
-	PHP
- SQL (phpMyAdmin pour la réalisation de la BDD)

Le thème : 
	Le thème de mon site était de créé un page de présentation pour les mangas et les animés, mais dans la mesure du temps il était plus simple de ce focaliser sur une partie et c’était donc les mangas. Un utilisateur peut voir une bibliothèque en ligne de manga ou il peut se renseigner sur ces derniers, les mettre en favoris dans son espace, laissé des commentaires et voir les commentaires des autres utilisateurs sur les mangas. Il a également la possibilité de modifier ses informations personnelles après la création de son profil. 
	
penser à importer la BDD (manga_universe.sql)

configurer l'acces à la BDD dans le fichier pagesconstantes/head.php

Les différents niveaux d’administrions : <br>
Niveau 1 = le créateur qui a tous les droits <br>
Niveau 2 = le modérateur qui a presque les mêmes droits que le créateur dans la gestion des œuvres mais il ne peut voir les profils des autres modérateur et ne peut créé de compte modérateur, i peut créer des comptes membre. <br>
Niveau 3 = membre simple qui est limité a son espace utilisateur <br>

Pour que vous puissiez tester mon site voici 2 scénarios selon les niveaux d’administration :

Scénario 1 – niveau 3 : <br>
1-	Je vous invite a créer votre propre compte utilisateur : (faite volontairement une erreur dans votre pseudo ou pseudo) <br>
2-	Une fois connecté, éditez votre profil pour corriger votre nom ou pseudo <br>
3-	Ensuite allé dans la bibliothèque, vous pouvez ajouter les œuvres a vos favoris, en cliquant sur voir lus vous avez plus d’information sur l’œuvre et vous pouvez laisser des commentaires <br>
Scénario 2 – niveau 2 et 3 : <br>
Niveau 2 : mail : xxx@gmail.com    mdp : test <br>
Niveau 1 : mail : boss@gmail.com mdp : test <br>

Les actions avec ces 2 comptes sont quelque peu identique  <br>

1-	Connection  <br>
2-	En vous connectant a ses comptes vous avez 2 nouveaux onglets qui apparaissent , gestion (utilisateur et mangas) <br>
3-	Gestion utilisateur : vous visualisez tout les comptes utilisateur (uniquement les membres si modérateur) <br>
4-	Vous pouvez supprimer un utilisateur, en rajouter (si vous êtes en creator, vous pouvez ajouter un compte modérateur ) <br>
5-	Avec « voir plus » vous pouvez voir les détails sur les comptes et voir les commentaires laisser par les utilisateurs. <br>
6-	En allant sur le compte pseudo = « usertest » vous verrez des commentaires que vous pourrez supprimer pour tester. <br>
7-	Dans l’espace gestion mangas vous aurez la liste de tous les mangas, vous pouvez mettre a jour le nombre de chapitre , vous pouvez supprimer le manga ( vous avez un manga fake que vous pouvez supprimer ) <br>
8-	vous pouvez également ajouter un manga  <br>
( url image : data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ8NDQ0NFREWFhURFRMYHSggGBolGxUVITEhJSkrOi4uFx8zODMtNygtLisBCgoKDQ0NDw0NDzcZFRkrLSsrKystLSsrLS0rLSsrKysrKystKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAWAAEBAQAAAAAAAAAAAAAAAAAAAQf/xAAXEAEBAQEAAAAAAAAAAAAAAAAAARFB/8QAFgEBAQEAAAAAAAAAAAAAAAAAAAEC/8QAFREBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhEDEQA/AMZFTGwAAAAAAAAAAAAAAAQAFBUAUAAAAABUAAAAAAAAAAAAAAAQUAAAAAAAAAAAAABQQAAAAAAAAAAABFAAAAAAARUUEAAAAVAFEAUAAAAAAAAAAAAAAAAAAAAABFAQUBAVBMFFBUAAAAAAAAAAAAAAAAAAABUAAAAQAFAMAUQAAAAAAAAAABUAAAAAAAAAAAAAABABVARQQAAIAAAAAAAAAAAAAAAAAAAAAAAAIKiooAAAAAAAAAAAAAAAAAAAAAAAIAChqpioCKKCKgCgCCoAAAACyotQAAAAAAAAAAAAABAUAAFBFARUUBAAAAABUFBAAAAAAAAAAAAAVAAAAUAAAAQVABUAAAAAAAAAAAAQAAAUEAAVFAAUAABFBAAAAAAAAAAAAAAAAAEFAUEFQNDQAEUUQAVAAAAAAAAAAAAAAAAAAAABAVAFEUEAUAAAAAAAAAAAAAAAAAAAQFEAUQBQAABAUFQAF4igJBQEIAgRQVIACLAEABUUCCCgkQAUgABVAQAR/9k=  ) <br>

9-	Effectuer une mise à jour du nombre de chapitres pour un manga . <br>

PS : il est imprtan de configurer la BDD pour faire fonctionné le site. <br>
Il s'agit d'un projet scholaire donc je me suis beaucoup plus attardé sur le fonctionnel que l'esthetique.
