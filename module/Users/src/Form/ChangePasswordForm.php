<?php
namespace Users\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
use Zend\Validator\NotEmpty;
use Zend\Validator\Identical;

class ChangePasswordForm extends Form{
    private $action;
    public function __construct($action = "changePw"){
        $this->action = $action;
        parent::__construct();
        $this->setAttributes([
            'name'=>'change-pw',
            'class'=>'form-horizontal'
        ]);
        $this->addElements();
        $this->addValidator();
    }
    private function addElements(){
        //old password
        if($this->action=="changePw"){
            $this->add([
                'type'=>'password',
                'name'=>'old_pw',
                'options'=>[
                    'label'=>'Mật khẩu cũ:',
                    'label_attributes'=>[
                        'class'=>'col-md-4'
                    ]
                ],
                'attributes'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Nhập mật khẩu cũ'
                ]
            ]);
        }
        //new pw
        $this->add([
            'type'=>'password',
            'name'=>'new_pw',
            'options'=>[
                'label'=>'Mật khẩu mới:',
                'label_attributes'=>[
                    'class'=>'col-md-4'
                ]
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'Nhập mật khẩu mới'
            ]
        ]);
        //confirm new pw
        $this->add([
            'type'=>'password',
            'name'=>'confirm_new_pw',
            'options'=>[
                'label'=>'Nhập lại mật khẩu mới:',
                'label_attributes'=>[
                    'class'=>'col-md-4'
                ]
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'Nhập lại mật khẩu mới'
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

        //btn
        $this->add([
            'type'=>'submit',
            'name'=>'submit',
            'attributes'=>[
                'class'=>'btn btn-primary',
                'value'=>'Lưu'
            ]
        ]);

    }

    private function addValidator(){
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);
        //old_pw
        if($this->action=="changePw"){
            $inputFilter->add([
                'name'=>'old_pw',
                'required'=>true,
                'filters'=>[
                    ['name'=>'StringTrim'],
                    ['name'=>'StripTags'],
                    ['name'=>'StripNewlines']
                ],
                'validators'=>[
                    [
                        'name'=>'NotEmpty',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'messages'=>[
                                NotEmpty::IS_EMPTY=>'Mật khẩu không được rỗng'
                            ]
                        ]
                    ],
                    [
                        'name'=>'StringLength',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'min'=>8,
                            'max'=>20,
                            'messages'=>[
                                StringLength::TOO_SHORT=>'Mật khẩu ít nhất %min% kí tự',
                                StringLength::TOO_LONG=>'Mật khẩu không quá %max% kí tự',
                            ]
                        ]
                    ],
                    [
                        'name'=>"Regex",
                        'options'=>[
                            'break_chain_on_failure'=>true,
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
                            'break_chain_on_failure'=>true,
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
        //new_pw
        $inputFilter->add([
            'name'=>'new_pw',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            NotEmpty::IS_EMPTY=>'Mật khẩu không được rỗng'
                        ]
                    ]
                ],
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'min'=>8,
                        'max'=>20,
                        'messages'=>[
                            StringLength::TOO_SHORT=>'Mật khẩu ít nhất %min% kí tự',
                            StringLength::TOO_LONG=>'Mật khẩu không quá %max% kí tự',
                        ]
                    ]
                ],
                [
                    'name'=>"Regex",
                    'options'=>[
                        'break_chain_on_failure'=>true,
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
                        'break_chain_on_failure'=>true,
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

        //confirm_new_pw
        $inputFilter->add([
            'name'=>'confirm_new_pw',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            NotEmpty::IS_EMPTY=>'Mật khẩu nhập lại không được rỗng'
                        ]
                    ]
                ],
                [
                    'name'=>'Identical',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'token'=>'new_pw',
                        'messages'=>[
                            Identical::NOT_SAME=>'Mật khẩu không giống nhau',
                            Identical::MISSING_TOKEN=>'Missing token'
                        ]
                    ]
                ],
                [
                    'name'=>"Regex",
                    'options'=>[
                        'break_chain_on_failure'=>true,
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


?>