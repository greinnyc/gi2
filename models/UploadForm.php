<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [ //'extensions' => ['csv'],
            [['file'], 'file', 'skipOnEmpty' => false],
            [['file'], 'file', 'extensions' => ['txt','csv','xlsx'], 'mimeTypes' => ['text/plain','application/vnd.ms-excel']],
        ];
    }
}