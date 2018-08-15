<?php

namespace App\Http\Controllers\Api;


class Status
{
	const REGISTER_CREATED = 'REGISTER_CREATED';
	const PROCESS_COMPLETE = 'PROCESS_COMPLETE';
	const ERROR_PARAMS = 'ERROR_PARAMS';
	const ERROR_PROCESS = 'ERROR_PROCESS';
	const ERROR_PERMISSIONS = 'ERROR_PERMISSIONS';
	const ERROR_NOT_FOUND = 'ERROR_NOT_FOUND';

	public $code = 'OK';
	public $description;
	public $details;

	public function setStatus($code, $description = null)
	{
		if ($description) {
			$this->description = $description;
		} else {
			switch ($description) {
				case Status::ERROR_PERMISSIONS:
					$this->description = 'No tienes permiso para realizar esta acción';
					break;
				case Status::ERROR_PARAMS:
					$this->description = 'Faltan datos necesarios para completar el procedimiento';
					break;
				case Status::REGISTER_CREATED:
					$this->description = 'La información se guardo correctamente';
					break;
				case Status::ERROR_NOT_FOUND:
					$this->description = 'No pudimos encontrar la información necesaria';
					break;
				case Status::PROCESS_COMPLETE:
					$this->description = 'El proceso se completo correctamente';
					break;
			}
		}

		$this->code = $code;
	}
}