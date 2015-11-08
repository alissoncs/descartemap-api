<?php

/* index.html */
class __TwigTemplate_a11dcf475ff2a45e9c0bbcc1b82984710944965cf0ebc4d04287da60c798dc66 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("skin.html", "index.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "skin.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<nav class=\"navbar navbar-default\">

    <div class=\"container-fluid\">
      <div class=\"navbar-header\">
        <strong class=\"navbar-brand\">
        DescarteMap
        Manager
        </strong>

      </div>

      <ul class=\"nav navbar-nav\">
        <li class=\"active\">
          <a href=\"#\">Locais</a>
        </li>
        <li><a href=\"/manager/logout\">Sair</a></li>
      </ul>

    </div>

  </nav>

<div id=\"main\" class=\"container\">

  <div ng-controller='MainController'>

    <div class=\"row\">
      <h1 class=\"col-xs-5\">Locais</h1>

      <div class=\"col-xs-4\">

        <br>
        <input type=\"text\" placeholder=\"Filtrar\" class=\"form-control\" ng-model=\"search.\$\">

      </div>

      <div class=\"col-xs-3 text-right\">
        <button class=\"btn btn-success btn-lg btn-raised\"
        data-toggle=\"modal\" data-target=\"#place-modal\" ng-click=\"openCreate(null)\" type=\"button\">Adicionar novo</button>
      </div>
    </div>

    <br>

    <div class=\"well\">
      <table class=\"table\">

        <thead>
          <tr>
            <td>Nome</td>
            <td>Cidade</td>
            <td>Bairro</td>
            <td>Rua</td>
            <td></td>
          </tr>
        </thead>

        <tbody>
          <tr ng-repeat=\"item in places | filter:search:strict\">

            <td>
              <strong>
                [[item.name]]
              </strong>
            </td>

            <td>
              [[item.address.city]]
            </td>
            <td>
              [[item.address.neighborhood]]
            </td>
            <td>
              [[item.address.street]]
            </td>
            <td>
              <span class=\"label label-success\" ng-show=\"item.active == true\">Ativo</span>
              <span class=\"label label-default\" ng-show=\"item.active == false\">Desativado</span>
            </td>

            <td class=\"text-right\">
              <button class=\"btn btn-sm btn-info\" ng-click=\"openEdit(item)\" data-toggle=\"modal\" data-target=\"#place-modal\">Editar</button>
              <button class=\"btn btn-sm btn-danger\" ng-click=\"delete(\$index)\">Excluir</button>
            </td>

          </tr>
        </tbody>
      </table>

      <div class=\"text-center\">
        <hr>
        <p>
          Resultados encontrados: [[places.length]]
        </p>
      </div>

    </div>

  <div class=\"well\">

<div class=\"modal\" id=\"place-modal\">
  <div class=\"modal-dialog modal-lg\">
      <div class=\"modal-content\">
          <div class=\"modal-header\">
              <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
              <h4 class=\"modal-title\" ng-show=\"placeStatement == 'create'\">Cadastrar</h4>
              <h4 class=\"modal-title\" ng-show=\"placeStatement == 'edit'\">Editar local</h4>
          </div>
          <div class=\"modal-body\">
            <br><br>
              <form name=\"place_form\">

                <div class=\"form-group row\" ng-class=\"{'has-error': place_form.name.\$invalid}\">
                  <label class=\"col-lg-2 control-label\">Nome</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" placeholder=\"Casa de despejo - SM\" class=\"form-control\"
                    name=\"name\"
                    ng-model=\"place.name\"
                    ng-required=\"true\"
                    ng-minlength=\"1\"
                    ng-maxlength=\"100\">
                    <p class=\"help-block\" ng-show=\"place_form.name.\$invalid\">Digite o campo</p>
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label\">Ativo</label>
                  <div class=\"col-lg-10\">
                    <input type=\"checkbox\" checked ng-model=\"place.active\">
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label\">Tipo</label>
                  <div class=\"col-lg-10\">
                    <select class=\"form-control\" name=\"type\" ng-model=\"place.type\"
                    ng-pattern=\"/^[A-Z]+\$/\">
                      <option ng-repeat=\"type in types\" value=\"[[type.alias]]\" ng-required=\"true\">[[type.name]]</option>
                    </select>
                  </div>
                </div>

                <hr>

                <div class=\"row\">
                  <div class=\"col-md-5\" ng-class=\"{'has-error': place_form.longitude.\$invalid}\">
                    <label class=\"col-lg-4 control-label\">Longitude</label>
                    <div class=\"col-lg-8\">
                      <input type=\"text\" placeholder=\"-24.1283617\" class=\"form-control\" ng-model=\"place.position.longitude\"
                      ng-required=\"true\"
                      name=\"longitude\"
                      ng-pattern=\"/^\\-?[0-9]{0,3}\\.\\d+\$/\">
                      <p class=\"help-block\" ng-show=\"place_form.longitude.\$invalid\">
                        Valor inválido
                      </p>
                    </div>
                  </div>

                  <div class=\"col-md-5\" ng-class=\"{'has-error': place_form.latitude.\$invalid}\">
                    <label class=\"col-lg-4 control-label required\">Latitude</label>
                    <div class=\"col-lg-8\">
                      <input type=\"text\" placeholder=\"-24.1283617\" class=\"form-control\" ng-model=\"place.position.latitude\" name=\"latitude\"
                      ng-required=\"true\"
                      ng-pattern=\"/^\\-?[0-9]{0,3}\\.\\d+\$/\">
                      <p class=\"help-block\" ng-show=\"place_form.latitude.\$invalid\">
                        Valor inválido
                      </p>
                    </div>
                  </div>

                  <div class=\"col-md-2\">
                    <button class=\"google-maps btn btn-sm btn-info\"
                    type=\"button\"
                    ng-click=\"open-maps\">
                      <strong>Mapa</strong>
                    </button>
                  </div>

                </div>

                <div id=\"map\"></div>

                <hr>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label required\">País</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" value=\"Brasil\" placeholder=\"Brasil\" class=\"form-control\" ng-model=\"place.address.country\"
                    name=\"country\"

                    ng-required=\"true\">
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label required\">Estado</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" value=\"RS\" placeholder=\"RS\" class=\"form-control\" ng-model=\"place.address.state\" ng-required=\"true\">
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label required\">Cidade</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" value=\"Porto Alegre\" placeholder=\"Porto Alegre\" class=\"form-control\" ng-model=\"place.address.city\" ng-required=\"true\">
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label required\">Bairro</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" placeholder=\"Petrópolis\" class=\"form-control\" ng-model=\"place.address.neighborhood\" ng-required=\"true\">
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label required\">Rua</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" placeholder=\"Rua dos Anjos, 213\" class=\"form-control\" ng-model=\"place.address.street\" ng-required=\"true\">
                  </div>
                </div>

                <div class=\"form-group row\">
                  <label class=\"col-lg-2 control-label\">CEP</label>
                  <div class=\"col-lg-10\">
                    <input type=\"text\" placeholder=\"90000-000\" class=\"form-control\" ng-model=\"place.address.zipcode\" ng-required=\"false\">
                  </div>
                </div>

              </form>

          </div>
          <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-success btn-lg btn-raised\"
              ng-disabled=\"loading == true\"
              ng-show=\"placeStatement == 'create'\" ng-click=\"save(place)\">Finalizar</button>
              <button type=\"button\" class=\"btn btn-info btn-lg btn-raised\"
              ng-show=\"placeStatement == 'edit'\"
              ng-disabled=\"loading == true\"
              ng-click=\"update(place)\">Salvar alterações</button>
          </div>
      </div>
  </div>
</div>


  </div>

  </div>


</div>

";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends "skin.html" %}*/
/* */
/* {% block content %}*/
/* <nav class="navbar navbar-default">*/
/* */
/*     <div class="container-fluid">*/
/*       <div class="navbar-header">*/
/*         <strong class="navbar-brand">*/
/*         DescarteMap*/
/*         Manager*/
/*         </strong>*/
/* */
/*       </div>*/
/* */
/*       <ul class="nav navbar-nav">*/
/*         <li class="active">*/
/*           <a href="#">Locais</a>*/
/*         </li>*/
/*         <li><a href="/manager/logout">Sair</a></li>*/
/*       </ul>*/
/* */
/*     </div>*/
/* */
/*   </nav>*/
/* */
/* <div id="main" class="container">*/
/* */
/*   <div ng-controller='MainController'>*/
/* */
/*     <div class="row">*/
/*       <h1 class="col-xs-5">Locais</h1>*/
/* */
/*       <div class="col-xs-4">*/
/* */
/*         <br>*/
/*         <input type="text" placeholder="Filtrar" class="form-control" ng-model="search.$">*/
/* */
/*       </div>*/
/* */
/*       <div class="col-xs-3 text-right">*/
/*         <button class="btn btn-success btn-lg btn-raised"*/
/*         data-toggle="modal" data-target="#place-modal" ng-click="openCreate(null)" type="button">Adicionar novo</button>*/
/*       </div>*/
/*     </div>*/
/* */
/*     <br>*/
/* */
/*     <div class="well">*/
/*       <table class="table">*/
/* */
/*         <thead>*/
/*           <tr>*/
/*             <td>Nome</td>*/
/*             <td>Cidade</td>*/
/*             <td>Bairro</td>*/
/*             <td>Rua</td>*/
/*             <td></td>*/
/*           </tr>*/
/*         </thead>*/
/* */
/*         <tbody>*/
/*           <tr ng-repeat="item in places | filter:search:strict">*/
/* */
/*             <td>*/
/*               <strong>*/
/*                 [[item.name]]*/
/*               </strong>*/
/*             </td>*/
/* */
/*             <td>*/
/*               [[item.address.city]]*/
/*             </td>*/
/*             <td>*/
/*               [[item.address.neighborhood]]*/
/*             </td>*/
/*             <td>*/
/*               [[item.address.street]]*/
/*             </td>*/
/*             <td>*/
/*               <span class="label label-success" ng-show="item.active == true">Ativo</span>*/
/*               <span class="label label-default" ng-show="item.active == false">Desativado</span>*/
/*             </td>*/
/* */
/*             <td class="text-right">*/
/*               <button class="btn btn-sm btn-info" ng-click="openEdit(item)" data-toggle="modal" data-target="#place-modal">Editar</button>*/
/*               <button class="btn btn-sm btn-danger" ng-click="delete($index)">Excluir</button>*/
/*             </td>*/
/* */
/*           </tr>*/
/*         </tbody>*/
/*       </table>*/
/* */
/*       <div class="text-center">*/
/*         <hr>*/
/*         <p>*/
/*           Resultados encontrados: [[places.length]]*/
/*         </p>*/
/*       </div>*/
/* */
/*     </div>*/
/* */
/*   <div class="well">*/
/* */
/* <div class="modal" id="place-modal">*/
/*   <div class="modal-dialog modal-lg">*/
/*       <div class="modal-content">*/
/*           <div class="modal-header">*/
/*               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>*/
/*               <h4 class="modal-title" ng-show="placeStatement == 'create'">Cadastrar</h4>*/
/*               <h4 class="modal-title" ng-show="placeStatement == 'edit'">Editar local</h4>*/
/*           </div>*/
/*           <div class="modal-body">*/
/*             <br><br>*/
/*               <form name="place_form">*/
/* */
/*                 <div class="form-group row" ng-class="{'has-error': place_form.name.$invalid}">*/
/*                   <label class="col-lg-2 control-label">Nome</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" placeholder="Casa de despejo - SM" class="form-control"*/
/*                     name="name"*/
/*                     ng-model="place.name"*/
/*                     ng-required="true"*/
/*                     ng-minlength="1"*/
/*                     ng-maxlength="100">*/
/*                     <p class="help-block" ng-show="place_form.name.$invalid">Digite o campo</p>*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label">Ativo</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="checkbox" checked ng-model="place.active">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label">Tipo</label>*/
/*                   <div class="col-lg-10">*/
/*                     <select class="form-control" name="type" ng-model="place.type"*/
/*                     ng-pattern="/^[A-Z]+$/">*/
/*                       <option ng-repeat="type in types" value="[[type.alias]]" ng-required="true">[[type.name]]</option>*/
/*                     </select>*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <hr>*/
/* */
/*                 <div class="row">*/
/*                   <div class="col-md-5" ng-class="{'has-error': place_form.longitude.$invalid}">*/
/*                     <label class="col-lg-4 control-label">Longitude</label>*/
/*                     <div class="col-lg-8">*/
/*                       <input type="text" placeholder="-24.1283617" class="form-control" ng-model="place.position.longitude"*/
/*                       ng-required="true"*/
/*                       name="longitude"*/
/*                       ng-pattern="/^\-?[0-9]{0,3}\.\d+$/">*/
/*                       <p class="help-block" ng-show="place_form.longitude.$invalid">*/
/*                         Valor inválido*/
/*                       </p>*/
/*                     </div>*/
/*                   </div>*/
/* */
/*                   <div class="col-md-5" ng-class="{'has-error': place_form.latitude.$invalid}">*/
/*                     <label class="col-lg-4 control-label required">Latitude</label>*/
/*                     <div class="col-lg-8">*/
/*                       <input type="text" placeholder="-24.1283617" class="form-control" ng-model="place.position.latitude" name="latitude"*/
/*                       ng-required="true"*/
/*                       ng-pattern="/^\-?[0-9]{0,3}\.\d+$/">*/
/*                       <p class="help-block" ng-show="place_form.latitude.$invalid">*/
/*                         Valor inválido*/
/*                       </p>*/
/*                     </div>*/
/*                   </div>*/
/* */
/*                   <div class="col-md-2">*/
/*                     <button class="google-maps btn btn-sm btn-info"*/
/*                     type="button"*/
/*                     ng-click="open-maps">*/
/*                       <strong>Mapa</strong>*/
/*                     </button>*/
/*                   </div>*/
/* */
/*                 </div>*/
/* */
/*                 <div id="map"></div>*/
/* */
/*                 <hr>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label required">País</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" value="Brasil" placeholder="Brasil" class="form-control" ng-model="place.address.country"*/
/*                     name="country"*/
/* */
/*                     ng-required="true">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label required">Estado</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" value="RS" placeholder="RS" class="form-control" ng-model="place.address.state" ng-required="true">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label required">Cidade</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" value="Porto Alegre" placeholder="Porto Alegre" class="form-control" ng-model="place.address.city" ng-required="true">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label required">Bairro</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" placeholder="Petrópolis" class="form-control" ng-model="place.address.neighborhood" ng-required="true">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label required">Rua</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" placeholder="Rua dos Anjos, 213" class="form-control" ng-model="place.address.street" ng-required="true">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*                 <div class="form-group row">*/
/*                   <label class="col-lg-2 control-label">CEP</label>*/
/*                   <div class="col-lg-10">*/
/*                     <input type="text" placeholder="90000-000" class="form-control" ng-model="place.address.zipcode" ng-required="false">*/
/*                   </div>*/
/*                 </div>*/
/* */
/*               </form>*/
/* */
/*           </div>*/
/*           <div class="modal-footer">*/
/*               <button type="button" class="btn btn-success btn-lg btn-raised"*/
/*               ng-disabled="loading == true"*/
/*               ng-show="placeStatement == 'create'" ng-click="save(place)">Finalizar</button>*/
/*               <button type="button" class="btn btn-info btn-lg btn-raised"*/
/*               ng-show="placeStatement == 'edit'"*/
/*               ng-disabled="loading == true"*/
/*               ng-click="update(place)">Salvar alterações</button>*/
/*           </div>*/
/*       </div>*/
/*   </div>*/
/* </div>*/
/* */
/* */
/*   </div>*/
/* */
/*   </div>*/
/* */
/* */
/* </div>*/
/* */
/* {% endblock %}*/
