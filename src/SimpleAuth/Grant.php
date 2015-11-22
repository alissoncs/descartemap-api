<?php 

namespace SimpleAuth;

use InvalidArgumentException;

final class Grant {

	/** Administrator */
	const ALL = 0;

	/** Mobile App */
	const LEVEL_1 = 1;

	/** Website */
	const LEVEL_2 = 2;

	/** Others */
	const LEVEL_3 = 3;

	/**
	 * Verifica se é uma permissão válida
	 * @param  int  $grantType
	 * @return boolean
	 */
	static public function isValid($grantType) {

		if(!is_int($grantType)) {
			throw new InvalidArgumentException('Grant type must be integer', 1);
		}

		return $grantType >= 0 && $grantType <= 3;

	}

}