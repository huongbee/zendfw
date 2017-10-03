<?php
namespace Form\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class FormElement extends Form{
    function __construct(){
        parent::__construct();

        $this->setName('contact');
        $this->setAttributes([
            'action' => '#',
            'class' => 'form-demo',
            'id' => 'form_id'
        ]);
        ///$this->setAttribute('method','GET');

        $textbox = new Element\Text('fullname');
        $textbox->setLabel('Fullname: ')
                ->getLabelAttributes([
                    'class'=>'form_label',
                    'id' => 'fullname_id'
                ]);
        $textbox->setAttributes([
            'class' => 'form-control',
            'id' => 'fullname',
            'placeholder' => 'Nhập họ tên'
        ]);
        $this->add($textbox);

        //hidden
        $hidden = new Element\Text('hidden_input');
        $hidden->setAttributes([
            'type' => 'hidden',
            'value' => 'zend FW - Khoapham.vn'
        ]);
        $this->add($hidden);

        //Number
        $age = new Element\Number('input_number');
        $age->setLabel('Chọn tuổi:')
            ->setLabelAttributes([
                'id' => 'age',
                'class' => 'control-label'
            ]);
        $age->setAttributes([
            'min' => 10,
            'max' => 50,
            'value' => 20,
            'class' => 'form-control'
        ]);
        $this->add($age);

        //email
        $email = new Element\Email('my_email');
        $email->setLabel('Email:')
            ->setLabelAttributes([
                'class' => 'control-label',
                'id' => 'email'
            ]);
        $email->setAttributes([
            'class' => 'form-control',
            'placeholder' => 'Nhập email',
            'required' => true
        ]);
        $this->add($email);


        //password
        $password = new Element\Password('my_password');
        $password->setLabel('Nhập mật khẩu: ');
        $password->setLabelAttributes([
            'class' => 'control-label',
            'id' => 'password_id'
        ]);
        $password->setAttributes([
            'class' => 'form-control',
            'minlength' => 6,
            'maxlength' => 20,
            'placeholder' => 'Nhập mật khẩu',
            'required' => true
        ]);
        $this->add($password);


        //radio
        $gender = new Element\Radio('gender');
        $gender->setLabel('Giới tính: ')
                ->setLabelAttributes([
                    'class' => 'control-label'
                ]);
        $gender->setValueOptions([
            'nam' => 'Nam',
            'nữ' => 'Nữ',
            'other' => 'Khác'
        ]);
        $gender->setAttribute('value','nam');
        $this->add($gender);

        //textarea
        $message = new Element\Textarea('message');
        $message->setLabel('Message: ')
                ->setLabelAttributes([
                    'class' => 'control-label'
                ])
                ->setAttributes([
                    'class' => 'form-control',
                    'rows' => 5,
                    'style' => "width:600px;resize:none"
                ]);
        $this->add($message);

        //Select
        $select = new Element\Select('my_select');
        $select->setLabel('Chọn môn học: ')
                ->setLabelAttributes([
                    'class' => 'control-label'
                ]);
        $select->setAttributes([
            'class' => 'form-control'
        ])
        ->setValueOptions([
            'php' => 'PHP',
            'zendfw' => 'Zend Framework',
            'html' => 'HTML'
        ]);
        $this->add($select);

        //file
        $file = new Element\File('my_file');
        $file->setLabel('Chọn ảnh: ')
            ->setLabelAttributes(['class'=>"control-label"]);
        $file->setAttributes([
            'multiple' => true
        ]);
        $this->add($file);


        //checkbox 
        $checkbox = new Element\Checkbox('my_checkbox');
        $checkbox->setLabel('Remember me: ');
        $checkbox->setAttributes([
            'checked' => true
        ]);
        $this->add($checkbox);
    


        //multicheck
        $multicheckbox = new Element\MultiCheckbox('multi_check');
        $multicheckbox->setLabel('Chọn sở thích');
        $multicheckbox->setAttributes([
            'id' => 'multi_checkID',
            'value' => ['bóng đá','bóng chuyền']
        ]);
        $multicheckbox->setValueOptions([
            'bóng đá' => 'Bóng đá',
            'bơi lội' => 'Bơi lội',
            'bóng chuyền' => 'Bóng chuyền',
            'bóng rổ' => 'Bóng rổ'
        ]);
        $this->add($multicheckbox);
        
        //color
        $this->add([
            'name' => 'my_color',
            'type' => 'Color',
            'options'=>[
                'label' => 'Chọn màu yêu thích:'
            ],
            'attributes'=>[
                'value' => '#ABC123'
            ]
        ]);

        //date
        $this->add([
            'name' => 'date',
            'type' => 'Date',
            'attributes'=>[
                'class'=>'form-control',
                'id'=>'birthdate'
            ],
            'options'=>[
                'label' => 'Chọn ngày tháng: ',
                'label_attributes'=>[
                    'class'=>'form-label'
                ]
            ]
        ]);

        //range
        $this->add([
            'name'=>'my_range',
            'type'=>'Range',
            'attributes'=>[
                'value'=>10,
                'min' => 5,
                'max' => 20,
                'class'=>'form-control'
            ],
            'options'=>[
                'label'=>'Chọn giá trị:',
                'label_attributes'=>[
                    'class'=>'form-label'
                ]
            ]
        ]);


        //button reset
        $this->add([
            'name' => 'btnReset',
            'type' => 'button',
            'attributes'=>[
                'class' => 'btn btn-success'
            ],
            'options'=>[
                'label' => 'Reset'
            ]
        ]);

        //button submit
        $this->add([
            'name' => 'btnSubmit',
            'type' => 'submit',
            'attributes'=>[
                'class' => 'btn btn-primary',
                'value' => 'Gửi'
            ],
           
        ]);

        //csrf
        $this->add([
            'name' => 'token',
            'type' => 'Csrf',
            'options'=>[
                'csrf_options'=>[
                    'timeout' => 600 //second=>10min
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
                    'font' => APPLICATION_PATH.'/data/font/PermanentMarker-Regular.ttf',
                    'fsize' => 50,
                    'width' => 400,
                    'height' => 150,
                    'dotNoiseLevel' => 300,
                    'lineNoiseLevel' => 5,
                    'expiration' => 120 // 2min
                ]
            ]
        ]);
        
        
    }
}



?>