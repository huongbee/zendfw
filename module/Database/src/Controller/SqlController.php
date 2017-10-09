<?php
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Predicate\Expression;

class SqlController extends AbstractActionController{

    public function AdapterDB(){
        $adapter = new Adapter([
            'driver'=>'Pdo_Mysql',
            'database'=>'zendframework',
            'username'=>'root',
            'password'=>'',
            'hostname'=>'localhost',
            'charset' =>'utf8'
        ]);
        return $adapter;
    }

    //select()
    //form()
    //where()
    public function selectAction(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('foods');
        $select->where(['id'=>2]); //select * from foods where id=2

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        // $selectString = $sql->buildSqlString($select);
        // $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }


    //set name table
    //columns()
    public function select02Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->columns(['mamon'=>'id','tenmon'=>'name','dongia'=>'price']);
        $select->where(['id'=>2]); 
        //select f.id as mamon,f.name as tenmonan, f.price as dongia from foods as f where id=2

        // $statement = $sql->prepareStatementForSqlObject($select);
        // $results = $statement->execute();
        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }

    //join()
    public function select03Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->columns(['mamon'=>'id','tenmon'=>'name','dongia'=>'price']);
        $select->join(['ft'=>'food_type'],'f.id_type = ft.id',[],$select::JOIN_LEFT);

        $select->where(['f.id'=>2]); 
        //select f.id as mamon,f.name as tenmonan, f.price as dongia from foods as f where id=2

        // $statement = $sql->prepareStatementForSqlObject($select);
        // $results = $statement->execute();
        $selectString = $sql->buildSqlString($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }

    //where()
    public function select04Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        
        // $select->where(function (Where $where) {
        //     $where->like('name', '%súp%');
        // });
        //$select->where('id_type=2');
        $select->where(['id_type=2','price<=50000']);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }


    public function select05Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        
        //$select->where(new \Zend\Db\Sql\Predicate\In('id',[1,2,3]));
        //NotIn
        //$select->where(new \Zend\Db\Sql\Predicate\Between('id',5,9));
        //$select->where(new \Zend\Db\Sql\Predicate\NotBetween('id',5,9));
        //$select->where(new \Zend\Db\Sql\Predicate\Expression("id = ? OR id = ?",[2,10]));
        //$select->where(new \Zend\Db\Sql\Predicate\Literal('id_type > 8'));
        //$select->where(new \Zend\Db\Sql\Predicate\Like('name', '%súp%'));
        $select->where(new \Zend\Db\Sql\Predicate\NotLike('name', '%súp%'));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }

    //order(), limit(), offset()
    public function select06Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        //$select->order('id DESC');
        $select->order('price ASC, id DESC'); 
        $select->limit(5)->offset(2);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        return false;
    }


    //group(), having()
    //Tính tổng số món ăn của mỗi loại, liệt kê mã loại, và tên loại
    //SELECT t.id as maloai, t.name as tenloai, count(f.id) as tongsoSP
    //FROM food_type t
    //LEFT JOIN foods f ON t.id = f.id_type
    //GROUP BY (t.id,t.name)

    //chỉ lấy các loại có số lượng món > 5
    //HAVING(tongsoSP>5)

    public function select07Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns([
            'maloai'=>'id',
            'tenloai'=>'name',
            'tongsoSP'=>  new \Zend\Db\Sql\Predicate\Expression("count(f.id)")
        ]);
        $select->from(['t'=>'food_type']);
        $select->join(
            ['f'=>'foods'],
            'f.id_type=t.id',
            [],
            $select::JOIN_LEFT
        );
        $select->group(['t.id','t.name']);
        $select->having('tongsoSP > 5');

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
        return false;
    }


    //tìm đơn giá trung bình, min, max theo loại
    
    public function select08Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns([
            'maloai'=>'id',
            'tenloai'=>'name',
            'tenloaiFormatUpper'=>  new \Zend\Db\Sql\Predicate\Expression("UPPER(t.name)"),
            'tenloaiFormatLower'=>  new \Zend\Db\Sql\Predicate\Expression("LOWER(t.name)"),
            'tongsoSP'=>  new \Zend\Db\Sql\Predicate\Expression("count(f.id)"),
            'tongDongia'=>  new \Zend\Db\Sql\Predicate\Expression("sum(f.price)"),
            'dongiaTB_basic'=>  new \Zend\Db\Sql\Predicate\Expression("sum(f.price)/count(f.id)"),
            'dongiaTB'=>  new \Zend\Db\Sql\Predicate\Expression("avg(f.price)"),
            'min'=>  new \Zend\Db\Sql\Predicate\Expression("min(f.price)"),
            'max'=>  new \Zend\Db\Sql\Predicate\Expression("max(f.price)"),
            'concatIdName' => new \Zend\Db\Sql\Predicate\Expression("concat(t.id, ' - ' ,t.name)"),
            'listFoods' => new \Zend\Db\Sql\Predicate\Expression("group_concat(f.name SEPARATOR '; ')"),
        ]);
        $select->from(['t'=>'food_type']);
        $select->join(
            ['f'=>'foods'],
            'f.id_type=t.id',
            [],
            $select::JOIN_LEFT
        );
        $select->group(['t.id','t.name']);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
        return false;
    }


    //multijoin
    //SELECT `f`.* FROM `foods` AS `f` LEFT JOIN `menu_detail` AS `md` ON `md`.`id_food`=`f`.`id` LEFT JOIN `menu` AS `m` ON `m`.`id`=`md`.`id_menu` WHERE m.id=2
    public function select09Action(){
        $adapter = $this->AdapterDB();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from(['f'=>'foods']);
        $select->join(['md'=>'menu_detail'],'md.id_food=f.id',[],$select::JOIN_LEFT)
            ->join(['m'=>'menu'],'m.id=md.id_menu',[],$select::JOIN_LEFT);
        $select->where('m.id=2');

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $sqlString = $sql->getSqlStringForSqlObject($select);
        echo '<pre>';
        echo $sqlString;
        echo '</pre>';
        foreach($results as $data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
        return false;
    }

    //insert
    public function insertAction(){
        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);

        $insert = $sql->insert('customers');
        $insert->values([
            'name'=>'Khoa Phạm Training',
            'gender'=>'nam',
            'email'=>'kpt@gmail.com',
            'address'=>'90-92 Lê Thị Riêng',
            'phone' => '012312312',
            'note'=>'Zend FW 3'
        ]);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $results = $statement->execute();
        echo $sqlString = $sql->getSqlStringForSqlObject($insert);
        echo "<br>";
        echo 'Inserted';
        return false;
    }
    
    //update
    public function updateAction(){
        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);

        $update = $sql->update('customers');
        $update->set([
            'phone'=>'0920145687',
            'address'=>'Phường Bến Nghé, Quận 1'
        ]);
        $update->where('id=12');
        $statement = $sql->prepareStatementForSqlObject($update);
        $results = $statement->execute();
        echo $sqlString = $sql->getSqlStringForSqlObject($update);
        echo "<br>";
        echo 'Updated';
        return false;
    }

    //delete
    public function deleteAction(){
        $adapter = $this->AdapterDB();
        $sql = new Sql($adapter);

        $delete = $sql->delete('customers');
        $delete->where('id=21');

        $statement = $sql->prepareStatementForSqlObject($delete);
        $results = $statement->execute();
        echo $sqlString = $sql->getSqlStringForSqlObject($delete);
        echo "<br>";
        echo 'Deleted';
        return false;
    }


}