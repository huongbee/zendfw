<?php
namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Validator\ValidatorInterface;
use Zend\Validator\StringLength;
use Zend\Validator\NotEmpty;

class ValidatorController extends AbstractActionController{

    //string
    public function stringAction(){
        //6
        //$validator = new StringLength(['min'=>6]);
        $validator = new StringLength(['max'=>10,'min'=>6]);
        $validator->setMessages([
            StringLength::TOO_SHORT=>"Giá trị %value% quá ngắn, yêu cầu ít nhất %min% kí tự",
            StringLength::TOO_LONG=>"Giá trị %value% quá dài, yêu cầu tối đa %max% kí tự"
        ]);
        //$var = "test"; //false;
        $var = "test";

        if($validator->isValid($var)){
            echo 'Thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            foreach($messages as $error){
                echo $error.'</br>';
            }
        }

        return false;
    } 
    //number
    public function numberAction(){
        $validator = new \Zend\Validator\Between([
            'min' => 5,
            'max' => 10,
            'inclusive' => true
        ]);
        $validator->setMessages([
            \Zend\Validator\Between::NOT_BETWEEN=>"Dữ liệu không nằm trong khoảng %min% và  %max%",
            \Zend\Validator\Between::NOT_BETWEEN_STRICT=>"Dữ liệu không nằm trong đoạn %min% và  %max%",
            \Zend\Validator\Between::VALUE_NOT_NUMERIC=>"Dữ liệu %value% không phải là số",
            \Zend\Validator\Between::VALUE_NOT_STRING=>"Dữ liệu %value% không phải là  chuỗi"
        ]);
       //  $num = 5;
        //$num = 3 ;
        //$num = "abc";
        //$num = "abc2";
        $num = "!@";
        if($validator->isValid($num)){
            echo 'Thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //date
    public function dateAction(){
        // $validator = new \Zend\Validator\Date([
        //     'format' => 'd-m-Y'
        // ]);
        //default = "Y-m-d";
        //$date = "2017-2-15"; //true
        //$date = '12-5-2017'; // false
        //$date = '2017/2/15'; //false
        $validator = new \Zend\Validator\Date([
            'format' => 'm'
        ]);
        //$date = "April"; false
        $date = 4;
        
        if($validator->isValid($date)){
            echo 'Thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //email
    public function emailAction(){
        $validator = new \Zend\Validator\EmailAddress();
        //$email = 'huong@gmail.com'; //true
        //$email = 'huong@gmailcom'; //false
        //$email = 'huong+abc@gmail.com'; //true
        //$email = 'huong\abc@gmail.com'; //false
        //$email = 'huong@huong@gmail.com';//false
        $email = '"huong@huong"@gmail.com'; //true

        if($validator->isValid($email)){
            echo ' Thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;
    }


    //digits số tự nhiên
    public function digitsAction(){
        $validator = new \Zend\Validator\Digits();
        $num = 1; //true
        $num = 1.1; //false
        // $num = '5'; //true
        // $num = 'cbs2'; //false
        if($validator->isValid($num)){
            echo 'thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;
    }
    

    //greaterThan >
    public function greaterThanAction(){
        $validator = new \Zend\Validator\GreaterThan([
            'min' => 10,
            'inclusive' => true // >=
        ]);
        $num = 15;//true
        $num = 10;
        $num = 9;
        if($validator->isValid($num)){
            echo 'thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;
    }

    //lessThan <

    public function lessThanAction(){
        $validator = new \Zend\Validator\LessThan([
            'max' => 10,
            'inclusive' => true // <=
        ]);
        $num = 15;
        $num = 10;
        $num = 9;
        if($validator->isValid($num)){
            echo 'thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;
    }


    //inArray
    public function inArrayAction(){
        //C1

        //COMPARE_STRICT //type & value
        //COMPARE_NOT_STRICT //value
        // $validator = new \Zend\Validator\InArray([
        //     'haystack' => ['value1','value2', 'value3',100,'valueN'],
        //     'strict' => \Zend\Validator\InArray::COMPARE_NOT_STRICT_AND_PREVENT_STR_TO_INT_VULNERABILITY //value
        // ]);
        //C2
        // $validator = new \Zend\Validator\InArray();
        // $validator->setHaystack(['value1','value2', 'value3', 'value4','valueN']);
        // $validator->setStrict(\Zend\Validator\InArray::COMPARE_NOT_STRICT_AND_PREVENT_STR_TO_INT_VULNERABILITY);
        // $validator->setRecursive(true)
        //$value = 'abc'; //false
        // $value = "value1"; //true
        //$value = '100'; //true
        //$value = 100; //true
        //$value = (int)("abc100"); //100 //0

        $validator = new \Zend\Validator\InArray([
            'haystack' => [
                'firstDemension' => ['value1','value2', 'value3',100,'valueN'],
                'secondDemension' => [0,1,2,5,6,8,100]
            ],
            'recursive' => true //validate có đệ quy
        ]);
        $value = 5; //true
        $value = "value6"; //flase
        $value = 100;

        if($validator->isValid($value)){
            var_dump($value);
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;
    }

    //notEmpty
    public function notEmptyAction(){
        //$validator = new  \Zend\Validator\NotEmpty();
        //$validator = new  \Zend\Validator\NotEmpty(NotEmpty::INTEGER);
        //$validator = new  \Zend\Validator\NotEmpty(NotEmpty::STRING);
        //$validator = new  \Zend\Validator\NotEmpty(NotEmpty::BOOLEAN);
        //$validator = new NotEmpty(NotEmpty::INTEGER | NotEmpty::ZERO);
        //$validator = new NotEmpty(NotEmpty::INTEGER , NotEmpty::ZERO);
        //C2
        $validator = new NotEmpty();
        $validator->setType(['integer','zero']);
        //$value = ''; //false
        //$value = 'abc'; //true
        //$value = 0; //false
        //$value = 10;
        //$value = '';
        $value = true;//true
        $value = 1;
        $value = "abc";
        $value = false; //false
        $value = "0";
        $value = 0;

        if($validator->isValid($value)){
            echo 'thỏa mãn'."\n";
            var_dump($value);
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;

    }

    //Regex
    public function regexAction(){
        $validator = new \Zend\Validator\Regex([
            'pattern' => "/^zend/" // chuối bắt đầu bằng zend
        ]);
        //$value = 'Lập trình Zend Framework'; //false
        //$value = 'Zend Framework'; //false
        //$value = 'zend Framework'; //true
        // $value = 'zendframework';

        // $pattern = "/^[\d]{5}$/";//số có 5 chữ số
        // $validator->setPattern($pattern);

        // $value = 12345; //true
        // $value = "12abc";

        $pattern = "/^[a-zA-Z ]*$/"; //kí tự và khoảng trắng
        $validator->setPattern($pattern);
    
        $value = "12abc"; //false
        $value = "Hello world"; //true
        $value = "#Hello world"; //false
        if($validator->isValid($value)){
            echo $value;
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }

        return false;
    }

    //file Exits
    public function fileExistsAction(){
        $validator = new \Zend\Validator\File\Exists();

        $validator->setMessages([
            \Zend\Validator\File\Exists::DOES_NOT_EXIST => 'File không tồn tại'
        ]);

        $file = APPLICATION_PATH.'/public/files/checkFileExits.txt';
        //$file = APPLICATION_PATH.'/public/files/check.jpg';
        if($validator->isValid($file)){
            echo 'Tồn tại file';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //file not Exits
    public function fileNotExistsAction(){
        $validator = new \Zend\Validator\File\NotExists();
        
        $file = APPLICATION_PATH.'/public/files/checkFileExits.txt';
        //$file = APPLICATION_PATH.'/public/files/check.jpg';
        if($validator->isValid($file)){
            echo 'không tồn tại file';
        }
        else{
            //có tồn tại
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }


    //check file extension
    public function fileExtensionAction(){
        //cho phép chọn các file .php .png
        //$validator = new \Zend\Validator\File\Extension(['php','png']);
        //$validator = new \Zend\Validator\File\Extension('php','png');

        $validator = new \Zend\Validator\File\Extension([
            'extension' => ['php','png','txt'],
            'case' => true //có phân biệt hoa thường file ext
        ]);
        $validator->setMessages([
            \Zend\Validator\File\Extension::FALSE_EXTENSION=>'File không được phép chọn',
            \Zend\Validator\File\Extension::NOT_FOUND => 'Không thể đọc file hoặc file không tồn tại'
        ]);
        $file = APPLICATION_PATH.'/public/files/checkFileExits.txt';
        //$file = APPLICATION_PATH.'/public/files/Capture.PNG';
        if($validator->isValid($file)){
            echo 'File được phép chọn';
        }
        else{
            //file không được phép
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //file Size
    public function fileSizeAction(){
        //$validator = new \Zend\Validator\File\Size(1024); //bytes// 1kb
        $validator = new \Zend\Validator\File\Size([
            'min' => 1024, //1kb
            'max' => 10*1024 //10kb
        ]);
        //cho phép các file trong khoản 1kb->5kb

        $file = APPLICATION_PATH.'/public/files/Capture.PNG'; //8kb
        //$file = APPLICATION_PATH.'/public/files/checkExt.php'; //38bytes
        if($validator->isValid($file)){
            echo 'file thỏa mãn';
        }
        else{
            //file quá lớn
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //image size (kích thước)
    public function imageSizeAction(){
        //min 320x200 max 640x480
        //$validator = new \Zend\Validator\File\ImageSize(320, 200, 640, 480);

        $validator = new \Zend\Validator\File\ImageSize([
            'maxWidth' => 640,
            'maxHeight' => 450
        ]);
        $file = APPLICATION_PATH.'/public/files/Capture.PNG';  //400x448
        if($validator->isValid($file)){
            echo 'file thỏa mãn';
        }
        else{
            //file quá kích thước
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //kiểm tra là hình ảnh
    public function isImageAction(){
        $validator = new \Zend\Validator\File\IsImage();
        //$file = APPLICATION_PATH.'/public/files/Capture.PNG'; 
        $file = APPLICATION_PATH.'/public/files/checkExt.php'; 
        if($validator->isValid($file)){
            echo 'file thỏa mãn';
        }
        else{
            //file ko phải là ảnh
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //kiểm tra file nén
    public function isCompressedAction(){
        $validator = new \Zend\Validator\File\IsCompressed();
        $file = APPLICATION_PATH.'/public/files/checkCompress.rar'; 
        //$file = APPLICATION_PATH.'/public/files/checkExt.php'; 
        if($validator->isValid($file)){
            echo 'file thỏa mãn';
        }
        else{
            //file ko phải là file nén
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //kiểm tra số từ trong file
    public function wordCountAction(){
        $validator = new \Zend\Validator\File\WordCount(10,20);
        
        $validator->setMessages([
            \Zend\Validator\File\WordCount::TOO_MUCH=>"Số từ vượt quá giới hạn %max%, file của bạn có %count% từ",
            \Zend\Validator\File\WordCount::TOO_LESS=>"Số từ quá ít, yêu cầu %min% từ, file của bạn hiện có %count% từ",
            \Zend\Validator\File\WordCount::NOT_FOUND=>'Không tồn tại file'
        ]);

        $file = APPLICATION_PATH.'/public/files/checkExt.php'; 
        if($validator->isValid($file)){
            echo 'file thỏa mãn';
        }
        else{
            //file vượt quá giới hạn từ
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    //password strength
    public function passwordStrengthAction(){
        $validator = new \Zend\Validator\PasswordStrength();

        //$password = '123456';
        $password = '12345678aA@';
        if($validator->isValid($password)){
            echo 'Password thỏa mãn';
        }
        else{
            $messages = $validator->getMessages();
            foreach($messages as $error){
                echo $error."<br>";
            }
        }
        return false;
    }

    //check Password vs passwordConfirm
    public function checkConfirmPasswordAction(){
        $validator = new \Zend\Validator\ConfirmPassword();
        $password = "123456@#$";
        //$confirmPassword = "123456";
        $confirmPassword = "123456@#$";
        $validator->setConfirmPassword($confirmPassword);
        if($validator->isValid($password)){
            echo 'Mật khẩu giống nhau';
        }
        else{
            $messages = $validator->getMessages();
            echo current($messages);
        }
        return false;
    }

    
}