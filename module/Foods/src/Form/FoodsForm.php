<?php
namespace Foods\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Form\Element;
use Zend\Validator\NotEmpty;
use Zend\Validator\Digits;
use Zend\InputFilter\FileInput;
use Zend\Validator\File\Size;
use Zend\Validator\File\MimeType;
use Zend\Validator\StringLength;

class FoodsForm extends Form{

    private $action;
    public function __construct($action = "add"){
        $this->action = $action;
        parent::__construct();

        $this->setAttributes([
            'class'=>'form-horizontal',
            'id'=>'foods_form',
            'enctype'=>'multipart/form-data'
        ]);
        $this->setElements();
        $this->validatorForm();
    }

    private function setElements(){
        //id
        $id = new Element\Text('id');
        $id->setAttributes([
            'type' => 'hidden'
        ]);
        $this->add($id);

        //id_type
        $id_type = new Element\Select('id_type');
        $id_type->setLabel('Chọn Loại: ')
                ->setLabelAttributes([
                    'class' => 'col-md-3 control-label'
                ]);
        $id_type->setAttributes([
            'class' => 'form-control'
        ]);
        $this->add($id_type);

        //name
        $name = new Element\Text('name');
        $name->setLabel('Tên món: ')
                ->setLabelAttributes([
                    'class'=>'col-md-3 control-label'
                ]);
        $name->setAttributes([
            'class' => 'form-control',
            'placeholder' => 'Nhập tên món ăn'
        ]);
        $this->add($name);

        //summary
        $summary = new Element\Textarea('summary');
        $summary->setLabel('Mô tả ngắn: ')
                ->setLabelAttributes([
                    'class' => 'col-md-3 control-label'
                ])
                ->setAttributes([
                    'class' => 'form-control',
                    'rows' => 3,
                    'style' => "resize:none"
                ]);
        $this->add($summary);

        //detail
        $detail = new Element\Textarea('detail');
        $detail->setLabel('Chi tiết món ăn: ')
                ->setLabelAttributes([
                    'class' => 'col-md-3 control-label'
                ])
                ->setAttributes([
                    'class' => 'form-control',
                    'rows' => 8
                ]);
        $this->add($detail);


        //price
        $price = new Element\Text('price');
        $price->setLabel('Đơn giá: ')
                ->setLabelAttributes([
                    'class'=>'col-md-3 control-label'
                ]);
        $price->setAttributes([
            'class' => 'form-control',
            'placeholder' => 'Nhập đơn giá:'
        ]);
        $this->add($price);

        //promotion
        $promotion = new Element\Select('promotion');
        $promotion->setLabel('Chọn khuyến mãi: ')
                ->setLabelAttributes([
                    'class' => 'col-md-3 control-label'
                ]);
        $promotion->setAttributes([
            'class' => 'form-control',
            'multiple'=>true
        ])
        ->setValueOptions([
            'nước ngọt'=>'Nước ngọt',
            'khăn lạnh'=>'Khăn lặnh'
        ]);
        $this->add($promotion);

        //image
        $image = new Element\File('image');
        $image->setLabel('Chọn ảnh: ')
            ->setLabelAttributes([
                'class'=>"col-md-3 control-label"
            ]);
        $image->setAttributes([
            'type'=>'file'
        ]);
        if($this->action=="add"){
            $image->setAttributes([
                'required'=>"required"
            ]);
        }
        
        $this->add($image);

        //unit
        $unit = new Element\Text('unit');
        $unit->setLabel('Đơn vị tính: ')
                ->setLabelAttributes([
                    'class'=>'col-md-3 control-label'
                ]);
        $unit->setAttributes([
            'class' => 'form-control',
            'placeholder' => 'Nhập đơn vị tính:'
        ]);
        $this->add($unit);

        
        //today
        $today = new Element\Radio('today');
        $today->setLabel('Món ăn trong ngày: ')
                ->setLabelAttributes([
                    'class' => 'col-md-3 control-label'
                ]);
        $today->setValueOptions([
            '0' => 'Không',
            '1' => 'Hôm nay'
        ]);
        $today->setAttribute('value','0');
        $this->add($today);


        //button submit
        $this->add([
            'name' => 'btnSubmit',
            'type' => 'submit',
            'attributes'=>[
                'class' => 'btn btn-primary',
                'value' => 'Save'
            ],
           
        ]);
    }

    private function validatorForm(){
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'=>'name',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags']
            ],
            'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'break_chain_on_failure'=>true,
                    'options'=>[
                        'messages'=>[
                            NotEmpty::IS_EMPTY => "Vui lòng nhập tên món"
                        ]
                    ]
                ],
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'max'=>150,
                        'messages'=>[
                            StringLength::TOO_LONG=>'Tên món ăn không quá %max% kí tự'
                        ]
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name'=>'price',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim']
            ],
            'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'break_chain_on_failure'=>true,
                    'options'=>[
                        'messages'=>[
                            NotEmpty::IS_EMPTY => "Vui lòng nhập đơn giá"
                        ]
                    ]
                ],
                [
                    'name'=>'Digits',
                    'options'=>[
                        'messages'=>[
                            Digits::NOT_DIGITS=>'Vui lòng nhập số'
                        ]
                    ]
                ]
            ]
        ]);

        if($this->action=="add"){
            $inputFilter->add([
                'name'=>'image',
                'required'=>true,
                'filters'=>[
                    ['name'=>'StringTrim']
                ],
                'validators'=>[
                    [
                        'name'=>'NotEmpty',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'messages'=>[
                                NotEmpty::IS_EMPTY => "Vui lòng chọn ảnh"
                            ]
                        ]
                    ],
                    [
                        'name'=>'filesize',
                        'options'=>[
                            'min'=>200*1024,
                            'max'=>2*1024*1024,
                            'break_chain_on_failure'=>true,
                            'messages'=>[
                                Size::TOO_SMALL=>'File quá nhỏ, dung lượng ít nhất %min%',
                                Size::TOO_BIG=>'File quá lớn, dung lượng tối đa %max%'
                            ]
                        ]
                    ],
                    [
                        'name'=>'fileMimeType',
                        'options'=>[
                            'mimeType'=>'image/png, image/jpeg, image/jpg, image/gif',
                            'messages'=>[
                                MimeType::FALSE_TYPE=>'Kiểu file %type% không được phép chọn',
                                MimeType::NOT_DETECTED=>'MimeType không xác định',
                                MimeType::NOT_READABLE => 'MineType không thể đọc'
                            ]
                        ]
                    ]
                ]
            ]);
        }
    }
}