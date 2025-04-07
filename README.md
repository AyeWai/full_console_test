# Vehicle Fleet Manager (CLI Symfony + DDD + CQRS)

This is a lightweight Symfony CLI-based project that demonstrates how to manage vehicle fleets using **Domain-Driven Design (DDD)**, **Command Query Responsibility Segregation (CQRS)**, and **SQLite** as a simple persistent storage mechanism.

---

## 🧑‍💻 Usage

All operations are accessible through the Symfony Console:

### 📦 Setup

```bash
composer install
php src/Infra/createDb.php
php src/Infra/Fixtures.php
```
Exemples:
```bash
php bin/console fulll:localize-vehicle 3 R3N-0LT 48.8566,2.3522 -vvv
php bin/console fulll:register-vehicle 2 AX2-DI3 -vvv
``` 
Step 3
For code quality, you can use some tools : which one and why (in a few words) ?

Nous pouvons utiliser php-cs-fixer, ce que j'ai fait ici ainsi que phpstan avec un niveau élevé voir maximum.De plus, étant donné que nous appliquons du CQRS, il serait interessant d'avoir un outil de monitoring des requêtes et commandes,
pour en voir la rapidité. 


you can consider to setup a ci/cd process : describe the necessary actions in a few words

Si je devais mettre en place un process CI/CD, dans le script que fait tourner gitlab avant validation des merge requests, j'aurais implémenter les classiques PHPStan et PHP CS Fixer mais aussi j'imgine Behat pour m'assurer que les tests
soient ok avant de pusher en production.


Remarsques : 

J'ai essayé de mettre en place les deux principales features qui fonctionnent plutôt correctement. IL faut prendre en compte les fixtures fournies que j'ai implémenté.

Notamment j'avais déjà mis en place un système de persistance prenant en compte des id crée directement dans le code. 
J'ai néanmoins recommencé en me disant qu'il n'était vraiment pas bon et maintenable bien sûr d'avoir en base des ids qui ne sont pas auto incrémentés.

Bien que le CQRS et le DDD étant respecté globalement, je me suis permis pour refaire ce code d'utiliser directement des repositories dans les Symfony console commands pour finir rapidement.
Je pense que les divers désagréments survenu auraient pu être éviter si j'avais utiliser des Value Object, chose dont je n'ai pas l'habitude et si j'avais moins le réflexe de me reposer sur Symfony (ORM + beau de debugagge à faire)

De même étant donné que je voulais finir cela en début de semaine, je n'ai pas eu le tmeps de mettre behat en place, mais j'aime beaucoup de principe par rapport à PHP. Il est vrai que couplé à l'UBiquitious Language, c'est très lisible !

Au delà de tout cela, si vous avez d'autres questions sur ce test, ce serait un plaisir de discuter avec l'équipe technique directement.
