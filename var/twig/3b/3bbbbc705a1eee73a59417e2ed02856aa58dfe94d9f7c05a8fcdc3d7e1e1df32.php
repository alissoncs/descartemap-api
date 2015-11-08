<?php

/* skin.html */
class __TwigTemplate_d952b5e1e603162641ef5a39d478a5126967c8cce8b4072051af28b80d09d3c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\">
  <title>Manager</title>

  <link rel=\"stylesheet\" href=\"/bower_components/bootstrap/dist/css/bootstrap.min.css\">

  <link rel=\"stylesheet\" href=\"/bower_components/bootstrap-material-design/dist/css/material.min.css\">
  <link rel=\"stylesheet\" href=\"/bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css\">
  <link rel=\"stylesheet\" href=\"/bower_components/bootstrap-material-design/dist/css/roboto.min.css\">
  <link rel=\"stylesheet\" href=\"/bower_components/bootstrap-material-design/dist/css/ripples.min.css\">

  <link rel=\"stylesheet\" href=\"/css/custom.css\">

  <script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyBMc2jGxgZ4LV-HTuU_m2ljhuYINIIVx3w\"></script>

  <script src='/bower_components/angular/angular.min.js'></script>
  <script src='/js/app.js'></script>
  <script src='/js/service.js'></script>
  <script src='/js/controller.js'></script>

  <script src='/bower_components/jquery/dist/jquery.min.js'></script>
  <script src='/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
  <script src='/bower_components/bootstrap-material-design/dist/js/material.min.js'></script>
  <script src='/bower_components/bootstrap-material-design/dist/js/ripples.min.js'></script>

  <script src='/js/custom.js'></script>

</head>
<body ng-app=\"dmap\">

";
        // line 33
        $this->displayBlock('content', $context, $blocks);
        // line 34
        echo "  
</body>
</html>";
    }

    // line 33
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "skin.html";
    }

    public function getDebugInfo()
    {
        return array (  62 => 33,  56 => 34,  54 => 33,  20 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/* <head>*/
/*   <meta charset="UTF-8">*/
/*   <title>Manager</title>*/
/* */
/*   <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">*/
/* */
/*   <link rel="stylesheet" href="/bower_components/bootstrap-material-design/dist/css/material.min.css">*/
/*   <link rel="stylesheet" href="/bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css">*/
/*   <link rel="stylesheet" href="/bower_components/bootstrap-material-design/dist/css/roboto.min.css">*/
/*   <link rel="stylesheet" href="/bower_components/bootstrap-material-design/dist/css/ripples.min.css">*/
/* */
/*   <link rel="stylesheet" href="/css/custom.css">*/
/* */
/*   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMc2jGxgZ4LV-HTuU_m2ljhuYINIIVx3w"></script>*/
/* */
/*   <script src='/bower_components/angular/angular.min.js'></script>*/
/*   <script src='/js/app.js'></script>*/
/*   <script src='/js/service.js'></script>*/
/*   <script src='/js/controller.js'></script>*/
/* */
/*   <script src='/bower_components/jquery/dist/jquery.min.js'></script>*/
/*   <script src='/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>*/
/*   <script src='/bower_components/bootstrap-material-design/dist/js/material.min.js'></script>*/
/*   <script src='/bower_components/bootstrap-material-design/dist/js/ripples.min.js'></script>*/
/* */
/*   <script src='/js/custom.js'></script>*/
/* */
/* </head>*/
/* <body ng-app="dmap">*/
/* */
/* {% block content %}{% endblock %}*/
/*   */
/* </body>*/
/* </html>*/
