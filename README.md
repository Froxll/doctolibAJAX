# Projet doctolibAJAX :

### Description du projet :
Le projet doctolibAJAX, comme l'explique son intitulé est un projet reprenant le principe de doctolib. Ayant déjà effectué ce projet en PHP, nous avons décidé de l'améliorer en utilisant la méthode AJAX.
Notre projet comporte 3 tables : patient, practicien et RDV. 
Chaque table est remplie et permet à notre site de fonctionner.

Le site est assez simple, il est composé d'un header contenant l'accueil, la page "mes RDV" et enfin la page "connexion/inscription". La page accueil présente une barre de recherche, nous permettant de trouver les différents médecins en fonction de leurs noms ou encore de leurs spécialités.
Après avoir recherché notre médecin, en tapant par exemple "nat", une liste de médecin dont le nom commencent par "nat" nous est présentés, contenant bien sûr un bouton pour prendre RDV avec ce médecin. A l'appui de ce bouton, les différentes horaires du médecin vont nous être présentées 
pour enfin prendre notre rendez-vous, que nous pourrons ensuite retrouver dans la page "mes RDV". 

### Prérequis :
Afin d'exécuter notre projet, il est nécessaire de remplir les différentes BDD. Un fichier SQL est présent dans le repository, sous le nom "doctolib.session.sql"
Les commandes à effectuer afin de créer la base de donnée "doctolib" contenant toutes nos tables et le rôle admin de cette base de donnée sont les suivantes :

Créer un nouveau rôle et ses droits :
```
create role <rolename> login password '<mypwd>' createdb createrole inherit;
```

Créer une base de données :
```
create database <dbname> owner <rolename>;
```

### Contributeurs :
GADBIN Nathan
MARZELIERE Hermann
