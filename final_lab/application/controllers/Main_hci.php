<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_hci extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('buyday_model');
		$this->load->model('categories_model');
		$this->load->model('products_model');
		$this->load->model('cart_model');
	}

	// ---------------------------------- [ Page  Seller ] ---------------------------------------
	// public function edit_sellers($seller_id)
	// {
	// 	$condition = array(
	// 		'seller_id' => $seller_id
	// 		// 'categories' => $this->mongo_db->create_document_id($categoriesID)
	// 	);
	// 	$data = array(
	// 		'seller_id' => $seller_id,
	// 		'detail' => $this->buyday_model->findOne_seller($condition)
	// 	);
	// 	$this->load->view('layout_hci/1_head');
	// 	$this->load->view('layout_hci/2_left_menu');
	// 	$this->load->view('layout_hci/3_top_bar');
	// 	$this->load->view('layout_hci/content/4_content_edit_sellers', $data);
	// 	$this->load->view('layout_hci/5_footer');
	// 	$this->load->view('layout_hci/6_right_bar');
	// 	$this->load->view('layout_hci/7_foot');
	// }
	


	

	


	// ---------------------------------- [ Page Stock ] ---------------------------------------
	public function index()
	{
		// $data['products_stock'] = $this->buyday_model->findAll_products();
		$data['categories'] = $this->categories_model->findAll();
		$this->load->view('layout_hci/1_head');
		$this->load->view('layout_hci/2_left_menu',$data);
		$this->load->view('layout_hci/3_top_bar');
		$this->load->view('layout_hci/4_content');
		$this->load->view('layout_hci/5_footer');
		$this->load->view('layout_hci/6_right_bar');
		$this->load->view('layout_hci/7_foot');
	}


	public function categories($id)
	{
		$search = $this->input->get('search');
        $name = $this->input->get('name');

        $condition = [];
        if (!empty($search)) {
            if (!empty($name)) {
                $condition['name'] = array('$regex' => $name);
            }
            
		}
		if (!empty($id)) {
			$condition['categories'] = $this->mongo_db->create_document_id($id);
		}

        $data['categories'] = $this->categories_model->findAll();
        $data['products'] = $this->products_model->findAll($condition);

        $data['name'] = $name;
        $data['search'] = $search;
		$data['id'] = $id;
		

		$this->load->view('layout_hci/1_head');
		$this->load->view('layout_hci/2_left_menu',$data);
		$this->load->view('layout_hci/3_top_bar');
		$this->load->view('layout_hci/content/4_content_stock',$data);
		$this->load->view('layout_hci/5_footer');
		$this->load->view('layout_hci/6_right_bar');
		$this->load->view('layout_hci/7_foot');
	}

	public function addCart($id,$name,$price)
	{
		$data = array(
			'name' => $name,
			'price' => (int)$price
		);
		$result = $this->cart_model->insert($data);
		$this->session->set_flashdata('success', 'pass');
		redirect('main_hci/categories/'.$id);

	}

	public function cart()
	{
		$data['carts'] = $this->cart_model->findAll();
		$this->load->view('layout_hci/1_head');
		$this->load->view('layout_hci/2_left_menu');
		$this->load->view('layout_hci/3_top_bar');
		$this->load->view('layout_hci/content/4_content_orderdetail',$data);
		$this->load->view('layout_hci/5_footer');
		$this->load->view('layout_hci/6_right_bar');
		$this->load->view('layout_hci/7_foot');
	}



	public function add_quntity($id, $qun)
	{
		$id_product = array(
			'id' => $id,
			'qun' => $qun
		);
		$this->load->view('layout_hci/1_head');
		$this->load->view('layout_hci/2_left_menu');
		$this->load->view('layout_hci/3_top_bar');
		$this->load->view('layout_hci/content/4_content_add_product_quntity', $id_product);
		$this->load->view('layout_hci/5_footer');
		$this->load->view('layout_hci/6_right_bar');
		$this->load->view('layout_hci/7_foot');
	}

	public function add_quntity_product_stock()
	{
		$quntity = $this->input->post();
		// print_r($quntity);
		$sum = (int) ($quntity['product_quntity_old'] + $quntity['product_add_quntity']);
		$product_id = (int) $quntity['product_id'];

		$updateStatus = $this->mongo_db
			->set('quntity', $sum)
			->where('product_id', $product_id)
			->update('products');

		$this->session->set_flashdata('success', 'pass');
		redirect('main_hci/stock');
	}


	// ---------------------------------- [ Page Users ] ---------------------------------------

	public function check_user()
	{
		$user = $this->input->post();
		$condition = array(
			'user_id' => $user['username'],
			'password' => $user['password']
			// 'order_id' => $this->mongo_db->create_document_id($order_id)
		);
		$key = $this->buyday_model->findOne_user($condition);
		if (!empty($key)) {
			$this->session->set_flashdata('success_login', 'pass');
			redirect('main_hci/home');
		} else {
			$this->session->set_flashdata('false', 'pass');
			redirect('');
		}
	}





	// Operation Function

	public function save()
	{
		$max_id = $this->buyday_model->find_max_product_id();
		$stock = array(
			'product_id' => $max_id['product_id'] + 1,
			'product_name' => $this->input->post('product_name_stock'),
			'unit' => $this->input->post('unit_stock'),
			'price' => $this->input->post('price_stock'),
			'quntity' => 0
		);
		$bill = array(
			'product_id' => $max_id['product_id'] + 1,
			'product_name' => $this->input->post('product_name_stock'),
			'price' => $this->input->post('price_sales')
		);
		$result = $this->buyday_model->insert_product($stock);
		$result2 = $this->buyday_model->insert_product_bill($bill);
		if (!empty($result)) {
			if (!empty($result2)) {
				$this->session->set_flashdata('success', 'pass');
				redirect('main_hci/stock');
			} else {
				$this->session->set_flashdata('false_insert_product_bill', 'pass');
			}
		} else {
			$this->session->set_flashdata('false_insert_product', 'pass');
		}
	}
}
