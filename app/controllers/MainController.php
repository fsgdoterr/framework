<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Test;

use PDO;

class MainController extends Controller
{
    public function main()
    {
        //$this->view->redirect('page', [15,]);
        //$this->view->render('main','layouts/layout',['first' => 'hello', 'second' => 'vitalii']);
        $test = new Test();
    }

    public function page()
    {
        $arr = func_get_arg(0);
        extract($arr);
        echo 'login<br>';
    }

    public function test_post()
    {
        $this->view->render('testpost');
    }
    public function test_post2()
    {
        $args = func_get_args();
        extract($args[0]);
        echo 'Вы ввели логин: ' . $request->name;
        echo '<br>';
        echo 'Ваш пароль: '     . $request->password;
    }
}

?>