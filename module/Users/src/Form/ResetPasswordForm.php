<?php
namespace Users\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
use Zend\Validator\NotEmpty;

class ResetPasswordForm extends Form{
    public function __construct(){
        parent::__construct();
        $this->setAttributes([
            'name'=>'reset-pw',
            'class'=>'form-horizontal'
        ]);
        $this->addElements();
        $this->addValidator();
    }
    private function addElements(){
       
        //email
        $this->add([
            'type'=>'email',
            'name'=>'email',
            'options'=>[
                'label'=>'Email:',
                'label_attributes'=>[
                    'class'=>'col-md-4'
                ]
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'Nhập email của bạn'
            ]
        ]);

        //csrf
        $this->add([
            'type'=>'csrf',
            'name'=>'csrf',
            'options'=>[
                'csrf_options'=>[
                    'timeout'=>600 //10phut
                ]
            ]
        ]);
        //Captcha Image
        $this->add([
            'type' => 'captcha',
            'name' => 'captcha_image',
            'options'=>[
                'label' => 'Nhập chuỗi bên dưới',
                'captcha' => [
                    'class' => 'Image',
                    'imgDir' => 'public/img/captcha',
                    'suffix' => '.png',
                    'imgUrl' => 'img/captcha',
                    'font' => APPLICATION_PATH.'/data/font/thorne_shaded.ttf',
                    'fsize' => 30,
                    'width' => 400,
                    'height' => 150,
                    'dotNoiseLevel' => 300,
                    'lineNoiseLevel' => 5,
                    'expiration' => 600 // 2min
                ]
            ]
        ]);

        //btn
        $this->add([
            'type'=>'submit',
            'name'=>'submit',
            'attributes'=>[
                'class'=>'btn btn-primary',
                'value'=>'Gửi'
            ]
        ]);

    }

    private function addValidator(){
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);
        $inputFilter->add([
            'name'=>'email',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'Regex',
                    'break_chain_on_failure'=>true,
                    'options'=>[
                        'pattern'=>"/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",
                        'messages'=>[
                            Regex::NOT_MATCH=>'Email phải chứa các kí tự %pattern%'
                        ]
                    ]
                ],
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            NotEmpty::IS_EMPTY=>'Email không được rỗng'
                        ]
                    ]
                ],
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'min'=>10,
                        'max'=>50,
                        'messages'=>[
                            StringLength::TOO_SHORT=>'Email ít nhất %min% kí tự',
                            StringLength::TOO_LONG=>'Email không quá %max% kí tự',
                        ]
                    ]
                ],
                [
                    'name'=>'EmailAddress',
                    'break_chain_on_failure'=>true,
                    'options'=>[
                        'messages'=>[
                            \Zend\Validator\EmailAddress::INVALID_FORMAT=>'Email không đúng định dạng',
                            \Zend\Validator\EmailAddress::INVALID_HOSTNAME=>'Hostname không đúng'
                        ]
                    ]
                ],
                
            ]
        ]);
    }
}


?>