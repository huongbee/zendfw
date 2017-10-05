<?php
namespace Form\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;
use Zend\Validator\File\Size;
use Zend\Validator\File\MimeType;


class UploadFile extends Form{

    public function __construct(){
        parent::__construct();

        $this->add([
            'name'=>'file-upload',
            'attributes'=>[
                'type'=>'file',
                'multiple'=>true
            ],
            'options'=>[
                'label'=>'Choose File'
            ]
        ]);

        //button submit
        $this->add([
            'name' => 'btnSubmit',
            'type' => 'submit',
            'attributes'=>[
                'class' => 'btn btn-primary',
                'value' => 'Upload'
            ],
           
        ]);

        //validator
        $this->uploadInputFilter();
    }

    public function uploadInputFilter(){
        $fileUpload = new FileInput('file-upload');
        $fileUpload->setRequired(true);

        //fileSize
        $size = new Size(['max'=>200*1024]); //200kB
        $size->setMessages([
            Size::TOO_BIG=>'File bạn chọn quá lớn, vui lòng chọn file có kích thước bé hơn %max%'
        ]);

        //MimeType
        //image/png, image/jpeg, image/jpg
        $mimeType = new MimeType('image/png, image/jpeg, image/jpg');
        $mimeType->setMessages([
            MimeType::FALSE_TYPE=>'Kiểu file %type% không được phép chọn',
            MimeType::NOT_DETECTED=>'MimeType không xác định',
            MimeType::NOT_READABLE => 'MineType không thể đọc'
        ]);

        $fileUpload->getValidatorChain()
                ->attach($size, true, 2)
                ->attach($mimeType,true,1);
        
        $inputFilter = new InputFilter();
        $inputFilter->add($fileUpload);
        $this->setInputFilter($inputFilter);
        
    }
}