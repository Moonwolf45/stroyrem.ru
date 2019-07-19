<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model {
    public $name;
    public $tel;
    public $email;
    public $body;
    public $at_file;
    public $reCaptcha;


    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['name', 'email', 'tel', 'body'], 'required'],
            ['email', 'email'],
            ['tel', 'string'],
            [['at_file'], 'file', 'maxFiles' => 6,
                'skipOnEmpty' => true],
            [['reCaptcha'], ReCaptchaValidator::class,
                'secret' => '6LfRS28UAAAAAEeUwpfk5z9QdE_hed9_yVendOM8',
                'uncheckedMessage' => 'Пожалуйста, подтвердите, что вы не робот.'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'name' => 'Имя',
            'tel' => 'Контактный номер',
            'email' => 'E-mail',
            'body' => 'Вопрос',
            'at_file' => 'Дополнительные файлы(до 6шт.)',
            'reCaptcha' => 'Капча',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function sendMail($email, $view, $subject, $params = []) {
        Yii::$app->mailer->getView()->params['name'] = $params['name'];
        Yii::$app->mailer->getView()->params['tel'] = $params['tel'];
        Yii::$app->mailer->getView()->params['email'] = $params['email'];
        Yii::$app->mailer->getView()->params['question'] = $params['question'];

        $result = Yii::$app->mailer->compose([
            'html' => 'views/' . $view . '-html',
            'text' => 'views/' . $view . '-text',
        ], $params);

        foreach ($params['at_file'] as $file) {
            $content_file = file_get_contents($file->tempName);
            $result->attachContent($content_file, [
                'fileName' => $file->baseName . '.' . $file->extension,
                'contentType' => $file->type]);
        }

        $result->setTo([$email]);
        $result->setSubject($subject);
        $result->send();

        Yii::$app->mailer->getView()->params['name'] = null;
        Yii::$app->mailer->getView()->params['tel'] = null;
        Yii::$app->mailer->getView()->params['email'] = null;
        Yii::$app->mailer->getView()->params['question'] = null;

        return $result;
    }
}
