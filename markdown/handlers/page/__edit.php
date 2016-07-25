<?php
$this->AddCSSFile('tools/markdown/libs/vendor/font-awesome-4.5.0/css/font-awesome.min.css');
$this->AddCSSFile('tools/markdown/libs/vendor/SimpleMDE/simplemde.min.css');
$this->AddJavascriptFile('tools/markdown/libs/vendor/SimpleMDE/simplemde.min.js');
$this->AddJavascript("var simplemde = new SimpleMDE({
  element: $('#SimpleMDE')[0],
  spellChecker : false,
  autofocus: true,
  promptURLs: true,
  autosave: {
    enabled: true,
    uniqueId: 'YesWikiEdit".$this->getPageTag()."',
    delay: 1000,
  },
  parsingConfig: {
    allowAtxHeaderWithoutSpace: false,
  },
  showIcons: ['horizontal-rule'],
  //toolbar: ['bold', 'italic', 'heading', '|', 'quote'],
});");
