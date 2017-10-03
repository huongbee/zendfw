<?php
namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Validator\ValidatorChain;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;


class ValidatorChainController extends AbstractActionController{

    public function indexAction(){
        //password
        //[6,20]
        //a-zA-Z0-9!@#$%^&*
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new StringLength(['min'=>6,'max'=>20]),false,3);
        $validatorChain->attach(new Regex('/[a-zA-Z0-9]/'),true,1);
        $validatorChain->attach(new Regex('/[!@#$%^&*.;:]/'),false,2);
        //true: break nếu gặp lỗi
        //1,2,3: mức độ ưu tiên của trình tự validator: 3>2>1

        $value = "12345";
        //$value = "123456789";
        //$value = "12364587$$";
        if($validatorChain->isValid($value)){
            echo "Dữ liệu đúng";
        }
        else{
            $messages = $validatorChain->getMessages();
            foreach($messages as $err){
                echo $err."<br>";
            }
        }
        return false;
    }

    public function customMessageDemoAction(){
        //password
        //[6,20]
        //a-zA-Z0-9!@#$%^&*
        $string = new StringLength(['min'=>6,'max'=>20]);
        $string->setMessages([
            StringLength::INVALID => 'Dữ liệu không hợp lệ',
            StringLength::TOO_SHORT=>"Dữ liệu bạn nhập quá ngắn, yêu cầu %min% kí tự",
            StringLength::TOO_LONG=>'Dữ liệu bạn nhập quá dài, yêu cầu %max% kí tự'
        ]);

        $regex = new Regex(['pattern'=>'/[a-zA-Z0-9]/']);
        $regex->setMessages([
            Regex::INVALID=>'Pattern không đúng',
            Regex::NOT_MATCH=>"Dữ liệu không hợp lệ cho patteen  %pattern%",
            Regex::ERROROUS =>"Lỗi nội bộ khi sử dụng pattern %pattern%"
        ]);
        
        $regex2 = new Regex(['pattern'=>'/[!@#$%^&*.;:]/']);
        $regex2->setMessages([
            Regex::INVALID=>'Pattern không đúng',
            Regex::NOT_MATCH=>"Dữ liệu không hợp lệ cho pattern %pattern%",
            Regex::ERROROUS =>"Lỗi nội bộ khi sử dụng pattern %pattern%"
        ]);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($string,false,3);
        $validatorChain->attach($regex,true,1);
        $validatorChain->attach($regex2,false,2);
        //true: break nếu gặp lỗi
        //1,2,3: mức độ ưu tiên của trình tự validator: 3>2>1

        //$value = "12345";
        //$value = "123456789";
        $value = "12364587$$";
        if($validatorChain->isValid($value)){
            echo "Dữ liệu đúng";
        }
        else{
            $messages = $validatorChain->getMessages();
            foreach($messages as $err){
                echo $err."<br>";
            }
        }
        return false;
    }
}