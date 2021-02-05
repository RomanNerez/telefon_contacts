<?php

require_once ROOT_APP.'models'.DS.'Contacts.php';

class PhoneController extends Controller
{
    public $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Contacts();
    }

    public function create()
    {
        $data = $_POST;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $value = array(
                'full_name'=> $data['full_name'],
                'phone' => $data['phone']
            );
            $this->model->insert($value);
            $message = ['success' => true];
            $this->view->render('phone.create','index', ['message' => $message]);
        }
        $this->view->render('phone.create','index');
    }

    public function edit ($id)
    {
        $data = $this->model->where('id', $id)->all()->fetchAll();
        $dataPost = $_POST;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $value = array(
                'full_name'=> $dataPost['full_name'],
                'phone' => $dataPost['phone']
            );

            $this->model->where('id', $id)->update($value);
            header("Location: /phone/list");
        }

        $this->view->render('phone.create','index', $data);
    }

    public function list()
    {
        $lists = $this->model->order('full_name')->all();
        $count = $lists->rowCount();

        $this->view->render(
            'phone.list',
            'index',
            [
                'lists' => $lists,
                'count' => $count
            ]
        );
    }

    public function search ()
    {
        sleep(2);
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $lists = $this->model->whereLike($data['column'], $data['text'])->all()->fetchAll();

        echo json_encode($lists);
    }

    public function deleteAjax(): bool
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->model->where('id', $data['id'])->delete();

        return true;
    }

    public function delete($id): bool
    {
        $this->model->where('id', $id)->delete();
        $redirect = $_SERVER['HTTP_REFERER'];
        header("Location: $redirect");
        return true;
    }
}