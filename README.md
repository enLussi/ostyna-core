# Framework Ostyna : Core

## 1. Système de routing

Les routes sont décrites et stockées dans le fichier routes.json du dossier config et se présente sous la forme :
```sh
"mainpage": {
    "path": "\/",
    "method": "App\\Controllers\\MainpageController::display"
}
```
où *path* correspond à l'url utilisée pour la page et *method* à la méthode du controller utilisé pour la page.
Une route est généré dans ce fichier automatiquement lors de la création d'un controller avec la commande associé
```sh
php bin/controller controller --new
```

## 2. Les controllers

Par défaut, à la génération de la classe de controller, une méthode *display* est créée avec une valeur de retour contenant le code html.
Au besoin, vous pouvez créer d'autres méthodes et les associés à une route dans le fichier routes.json du dossier config.

Un controller hérite de la classe abstraite ***AbstractPageController*** avec la méthode *render*.
Cette méthode demande deux paramètres : le chemin vers le template ou le fichier html et un tableau de paramètres utile si vous utilisez le moteur de template associé au framework (Sing)

## 3. Les Formulaires

Un formulaire est instancié avec la classe *Ostyna\Component\Framework\Form\FormArchitect*. Une fois instancié, la méthode *add* permet d'ajouter des éléments de formulaire. 
Cette méthode demande un paramètre: un *FormElement*
+ InputCheckbox
+ InputColor
+ InputDate
+ InputDateTime
+ InputEmail
+ InputFile
+ InputNumber
+ InputPassword
+ InputRadio
+ InputRadio
+ InputSearch
+ InputSubmit
+ InputTel
+ InputTime
+ Select + Option
+ Textarea

Dans la majorité des cas, un *FormElement* demande: un paramètre *name* correspondant à l'attribut name de la balise html, un objet Label, et un tableau d'attributs 
correspondant aux autres attributs html.

Avant de pouvoir être envoyé à la vue, le formulaire doit être formatté en utilisant la méthode *build*.
```sh
  return $this->render('/web/index.html', [
    'form' => $form->build(),
  ]);
```

