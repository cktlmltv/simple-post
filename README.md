# Simple Post

C'est un outils de publication de billet crypté en ligne, anonyme et open source. Les données sont chiffrées / déchiffrées dans le navigateur avec une clée est transmise via l'url.

> Une idée, et internet pour la diffuser.
  - Créer une page unique.
  - Rédiger votre billet.
  - Publier le en un clic.

### Version
0.0.1

### Installation

Cloner le projet :
```sh
$ git clone https://github.com/cktlmltv/simple-post.git
```
Si on a besoin d'installer composer php :
```sh
$ php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '7228c001f88bee97506740ef0888240bd8a760b046ee16db8f4095c0d8d525f2367663f22a46b48d072c816e7fe19959') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```
On installe les dépendences : 
```sh
$ php composer.phar install
```
### Base de donnée
La structure est disponible ici [simple-post.sql]
### On utilise
**Php**
* [ComposerPhp] - Dependency Manager for PHP 
* [SlimPhp] - Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs. 
* [Idiorm] - A lightweight nearly-zero-configuration object-relational mapper and fluent query builder for PHP5

**Javscript**
* [jquery] - jQuery is a fast, small, and feature-rich JavaScript library.
* [ContentTools] - A beautiful & small content editor 
* [SJCL] - Stanford Javascript Crypto Library

**Css**
* [FontAwesome] - The iconic font and CSS toolkit
* [Twitter Bootstrap] - Sleek, intuitive, and powerful front-end framework for faster and easier web development.

**Images**
* [TheNounProject] - Organize, share and use all your visual assets – all from your desktop.


### Development

Envie de contribuer, pas de soucis envoie moi un mail : cktlmltv@openmailbox.org

### License
----
**The Unlicense ! Free Software, Hell Yeah!**

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

[ComposerPhp]:<https://getcomposer.org/>
[SlimPhp]:<http://www.slimframework.com/>
[Idiorm]: <https://github.com/j4mie/idiorm>
[jquery]: <https://jquery.com/>
[ContentTools]:<http://getcontenttools.com/> 
[SJCL]:<https://crypto.stanford.edu/sjcl/>
[FontAwesome]:<https://fortawesome.github.io/Font-Awesome/> 
[Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
[TheNounProject]:<https://thenounproject.com/>
[simple-post.sql]:<https://raw.githubusercontent.com/cktlmltv/simple-post/master/simple-post.sql>

