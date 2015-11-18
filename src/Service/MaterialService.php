<?php 

namespace Service;

class MaterialService {

	public function findAll(array $options = array()) {

		$in = [
	    'Papelão',
	    'Caixa de leite',
	    'Garrafas pet',
	    'Frascos de produtos',
	    'Tubos PVC',
	    'Caneta sem tinta',
	    'Jornais e revistas',
	    'Listas telefônicas',
	    'Papel Sulfite',
	    'Papel',
	    'Caixas',
	    'Adesivos',
	    'Garrafas de vidro',
	    'Tampa de garrafa',
	    'Latinhas',
	    'Panelas',
	    'Ferragens',
	    'Pregos',
	    'Papel alumínio limpo',
	    'Clipes',
	    'Grampos',
	    'Solventes',
	    'Alumínio',
	    'Cobre',
	    'Zinco',
	    'Lâmpada',
	    'Cartucho de impressora',
	    'Gesso',
	    'Galhos',
	    'Pneu',
	    'Plásticos',
	    'Móveis',
	    'Caliça',
	    'Telhas',
	    'Materiais de construção',
	    'Óleo de cozinha',
	    'Arame',
	    'Esponja de aço',
	    'PVC',
	    'Espuma',
	    'Isopor',
	    'Acrílicos',
	    'Latas de alimentos',
	    'Porcelana',
	    'Cerâmica'
	  ];

	  $data = array();
	  foreach($in as $index => $value) {
	    $data[] = ['ref' => $index, 'name' => $value];
	  }

	  return $data;

	}

}