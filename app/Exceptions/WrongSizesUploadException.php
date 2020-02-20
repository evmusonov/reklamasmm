<?php

namespace App\Exceptions;

use App\Components\FileHelper;
use Exception;
use Illuminate\Support\Facades\Log;

class WrongSizesUploadException extends Exception
{
	public function report()
	{
		Log::channel('upload')->error('File: ' . $this->getFile() . ', line: ' . $this->getLine() . ', message: ' . $this->getMessage());
	}

	public function render($request)
	{
		return redirect($request->path())->with('uploadError', 'Извините, ваше изображение было загружено с ошибками. Пожалуйста, обратитесь к Администратору.');
	}
}
