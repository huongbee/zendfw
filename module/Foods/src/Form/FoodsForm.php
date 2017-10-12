<?php
namespace Foods\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFiler;
use Zend\Form\Element;

class FoodsForm extends Form{

    public function __construct(){
        parent::__construct();

        $this->setAttributes([
            'class'=>'form-horizontal',
            'id'=>'foods_form',
            'enctype'=>'multipart/form-data'
        ]);
        $this->setElements();
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
            'class' => 'form-control'
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
}