<?php

require_once ('application/models/NewsModel.php');

class MainController extends Controller
{
    function action_index()
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $news = new NewsModel();
        $data = $news->get_list($page);
        $total_pages = $news->total_pages;

        $this->view->generate('MainView.php', 'template_view.php', ['data' => $data, 'page' => $page, 'total_pages' => $total_pages]);
    }

    function action_edit()
    {
        $news = new NewsModel();
        $data = $news->get_for_edit($_REQUEST['id']);

        $data_json = json_encode($data);

        echo  $data_json;
    }

    function action_save()
    {
        $news = new NewsModel();

        $store = $news->store($_REQUEST['header'], $_REQUEST['content']);
        
        echo $store;
    }

    function action_delete()
    {
        $news = new NewsModel();

        $delete = $news->delete($_REQUEST['id']);

        echo $delete;
    }

    function action_update($header, $content, $id)
    {
        $news = new NewsModel();
        $data = $news->update($header, $content, $id);

        echo  $data;
    }
}