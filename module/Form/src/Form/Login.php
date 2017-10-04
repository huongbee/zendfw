<?php
namespace Form\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class Login extends Form{
    public function __construct(){
        parent::__construct();
        
        $this->loginForm(); //định nghĩa form
        $this->loginInputFilter(); //định nghĩa cho filter+validate
    }

    //create textfield
    private function loginForm(){
        //email
        $email = new Element\Email('email');
        $email->setLabel('Email: ')
            ->setLabelAttributes([
                'for' => 'email',
                'class' => 'col-sm-3 control-label'
            ]);
        $email->setAttributes([
            'id'=>'email',
            'class'=>'form-control',
            'placeholder' => 'example@domain.com'
        ]);
        $this->add($email);

        //password
        $pw = new Element\Password('password');
        $pw->setLabel('Password:')
            ->setLabelAttributes([
                'for' =>'password',
                'class'=>'col-sm-3 control-label'
            ]);
        $pw->setAttributes([
            'id'=>'password',
            'class'=>'form-control',
            'placeholder'=>'Enter your pass'
        ]);
        $this->add($pw);

        //remember
        $remember_me = new Element\Checkbox('remember');
        $remember_me->setLabel('Remember me: ')
                    ->setLabelAttributes([
                        'for'=>'remember'
                    ]);
        $remember_me->setAttributes([
            'id'=>'remember',
            'value'=>1,
            'required'=>false
        ]);
        $this->add($remember_me);

        //submit
        $submit = new Element\Submit('submit');
        $submit->setAttributes([
            'value'=>'Login',
            'class'=>'btn btn-success'
        ]);
        $this->add($submit);


    }

    //create inputfilter
    private function loginInputFilter(){
        $inputFilter = new InputFilter\InputFilter();
        $this->setInputFilter($inputFilter);
        $inputFilter->add([
            'name'=>'email',
            'required'=>true,
            'filters'=>[
                //trim/newline/tolower/toupper
                ['name'=>'StringToLower'],
                ['name'=>'StringTrim']
            ],
            'validators'=>[
                [
                    'name'=>'EmailAddress',
                    'options'=>[
                        'messages'=>[
                            \Zend\Validator\EmailAddress::INVALID_FORMAT=>'Email không đúng định dạng',
                            \Zend\Validator\EmailAddress::INVALID_HOSTNAME=>'Hostname không đúng'
                        ]
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name'=>'password',
            'required'=>true,
            'filters'=>[
                //trim/newline/tolower/toupper
                ['name'=>'StringToLower'],
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'min'=>6,
                        'max'=>20,
                        'messages'=>[
                            \Zend\Validator\StringLength::TOO_SHORT=>'Mật khẩu ít nhất %min% kí tự',
                            \Zend\Validator\StringLength::TOO_LONG=>'Mật khẩu không quá %max% kí tự'
                        ]
                    ]
                ],
                [
                    'name'=>"Regex",
                    'options'=>[
                        'pattern'=>'/[a-zA-Z0-9_-]/',
                        'messages'=>[
                            \Zend\Validator\Regex::INVALID=> "Pattern %pattern% không chính xác",
                            \Zend\Validator\Regex::NOT_MATCH=> "Mật khẩu phải chưa các kí tự sau %pattern%",
                            \Zend\Validator\Regex::ERROROUS=> "Có lỗi nội bộ đối với pattern %pattern%",
                        ]
                    ]
                ],
                [
                    'name'=>"Regex",
                    'options'=>[
                        'pattern'=>'/[!@#$%^&]/',
                        'messages'=>[
                            \Zend\Validator\Regex::INVALID=> "Pattern %pattern% không chính xác",
                            \Zend\Validator\Regex::NOT_MATCH=> "Mật khẩu phải chưa các kí tự sau %pattern%",
                            \Zend\Validator\Regex::ERROROUS=> "Có lỗi nội bộ đối với pattern %pattern%",
                        ]
                    ]
                ]
            ]
        ]);

    }
}