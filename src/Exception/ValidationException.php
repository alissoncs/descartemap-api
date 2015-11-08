<?php

namespace Exception;

use Sirius\Validation\Validator;

class ValidationException extends \Exception {

	private $errors;

	public function __construct($validator = null, $code = null) {

		$this->message = 'Validation error';
		$this->code = 12;
		$this->errors = [];

		if($validator instanceof Validator) {

			$errors = $validator->getMessages();

			if(count($errors) > 0) {
				foreach($errors as $index => $data) {

					$this->errors[$index] = array();

					foreach($data as $message) {
						$this->errors[$index][] = (string)$message;
					}

				}
			}
		}

	}

	public function getErrors() {

		return ['validation_error' => $this->errors];

	}

}
