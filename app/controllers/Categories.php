<?php
class Categories extends Controller
{
    public function index($page = 1)
    {
        $per_page = 3; // Здесь указываем сколько элементов будет отображаться на странице
        $page = $page == 1 ? 0 : ($page - 1) * $per_page;
        $limit = $page.','.$per_page;
        $products = $this->model('Products');
        $pagesForPagination = ceil($products->countProducts() / $per_page);

        $data = [
            // Вызываем другую функцию с передачей limit
            'products' => $products->getProductsLimited('id', $limit),
            'title' => 'Все товары на сайте',
            'pages' => $pagesForPagination // Передаем также количество страниц
        ];
          $this->view('categories/index', $data);
    }

    public function shoes()
    {
        $products = $this->model('Products');
        $data=['products'=>$products->getProductsСategory('shoes'),'title'=>'Категория обувь'];
        $this->view('categories/index', $data);
    }

    public function hats()
    {
        $products = $this->model('Products');
        $data=['products'=>$products->getProductsСategory('hats'),'title'=>'Категория кепки'];
        $this->view('categories/index', $data);
    }
    public function shirts()
    {
        $products = $this->model('Products');
        $data=['products'=>$products->getProductsСategory('shirts'),'title'=>'Категория футболки'];
        $this->view('categories/index', $data);

    }
    public function watches()
    {
        $products = $this->model('Products');
        $data=['products'=>$products->getProductsСategory('watches'),'title'=>'Категория часы'];
        $this->view('categories/index', $data);
    }

}



