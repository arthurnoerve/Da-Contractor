# Da Contractor


![Da Contractor home](image.png)


## Description
Da Contractor is a simple little tool made to create pdf contracts. It shows you all the markdown templates in the templates folder and allows you to fill out its variables in a form before you generate it.

## Installation
Run the following with composer and bower:

```bash
composer install
bower install
```

### Your signature
If you want to put your signature as a png file with a white/transparent background in the public folder: ```public/signature.png```. This will then get pasted on the first signature line.

### Web setup
It's up to you whether you want to clone the repo directly into a folder accessible from localhost, start a web server just for this folder or symlink /public to your central www root. It was built using a MAMP installation and a symlink.

### Environment variables
Copy .env.example to .env and add relevant values.

## Templating
Markdown for the win, use as you please. The variable syntax, which is the same used in Twig (PHP) and Angular (JS), is as follows:

```
{{variable_name}}
{{variable_name|default_value}}
```
