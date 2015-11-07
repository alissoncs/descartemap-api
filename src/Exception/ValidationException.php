<?php 

namespace Exception;

use Symfony\Component\Validator\ConstraintViolationList;

class ValidationException extends \Exception {

	private $errors;

	public function __construct($errors = null, $code = null) {

		$this->message = 'Validation error';
		$this->code = 12;
		$this->errors = [];

		if($errors instanceof ConstraintViolationList) {

			if(count($errors) > 0) {
				foreach($errors as $error) {
					$this->errors[][$error->getPropertyPath()] = $error->getMessage();
				}
			}
		}

	}

	public function getErrors() {

		return $this->errors;

	}

}