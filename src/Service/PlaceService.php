<?php 

namespace Service;

class PlaceService {

  public function getOne($app) {

    $faker = $app['faker'];

    return [
      'id' => $faker->unique()->randomDigitNotNull,
      'name' => $faker->company,
      'type' => $this->gen($faker),
      'contact' => [
        'phones' => [
          [
            'number' => $faker->phoneNumber,
          ],
          [
            'number' => $faker->phoneNumber,
          ]
        ],
        'email' => $faker->freeEmail,
        'facebook_fp' => $faker->url,
        'site' => $faker->domainName,
      ],
      'address' => [
        'street' => $faker->streetAddress,
        'neighborhood' => $faker->streetName,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->country,
        'zipcode' => $faker->postCode
      ],
      'location' => [
        'lat' => $faker->latitude,
        'lng' => $faker->longitude
      ],
      'accepted_materials' => [
        [
          'id' => $faker->randomDigitNotNull,
          'name' => $faker->colorName
        ],
        [
          'id' => $faker->randomDigitNotNull,
          'name' => $faker->colorName
        ],
        [
          'id' => $faker->randomDigitNotNull,
          'name' => $faker->colorName
        ]
      ],
      'avaliation' => [
        'up_vote' => $faker->randomDigitNotNull,
        'down_vote' => $faker->randomDigitNotNull,
      ],
      'date_insert' => $faker->dateTimeThisCentury->format('Y-m-d H:i:s'),
      'date_last_update' => $faker->dateTimeThisCentury->format('Y-m-d H:i:s')
    ];

  }

  public function getAll($app) {

    return $this->getAllSimple($app);

  }

  public function getAllSimple($app) {

    $faker = $app['faker'];

    $data = array();
    for($i = 0; $i < $app['faker']->randomDigitNotNull; $i++) {
      $data[] = [
        'id' => $faker->unique()->randomDigitNotNull,
        'name' => $faker->company,
        'type' => $this->gen($faker),
        'location' => [
          'lat' => $faker->latitude,
          'lng' => $faker->longitude
        ],
      ];
    }

    return $data;

  }

  private function gen($faker) {
    return strtoupper($faker->randomElement(
      ['ALL', 'recycling', 'COOK_OIL', 'OTHER', 'BATTERY', 'ELETRONIC', 'HOSPITAL']
    ));
  }

}