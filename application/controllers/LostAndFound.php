<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LostAndFound extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('LostAndFound');
		$this->load->view('templates/footer');
	}

	public function Find()
	{
		$this->load->view('templates/header');
		$this->load->view('Find');
		$this->load->view('templates/footer');
	}

	public function NewFind()
	{
		$this->load->view('templates/header');
		$this->load->view('NewFind');
		$this->load->view('templates/footer');
	}

	public function Lost()
	{
		$this->load->view('templates/header');
		$this->load->view('Lost');
		$this->load->view('templates/footer');
	}

	public function NewLost()
	{
		$this->load->view('templates/header');
		$this->load->view('NewLost');
		$this->load->view('templates/footer');
	}

	public function FindFeedback()
	{
		$this->load->view('templates/header');
		$this->load->view('FindFeedback');
		$this->load->view('templates/footer');
	}

	public function FindDetails()
	{
		$this->load->view('templates/header');
		$this->load->view('FindDetails');
		$this->load->view('templates/footer');
	}

	public function LostFeedback()
	{
		$this->load->view('templates/header');
		$this->load->view('LostFeedback');
		$this->load->view('templates/footer');
	}

	public function LostDetails()
	{
		$this->load->view('templates/header');
		$this->load->view('LostDetails');
		$this->load->view('templates/footer');
	}

	public function Admin()
	{
		$this->load->view('templates/header');
		$this->load->view('Admin');
		$this->load->view('templates/footer');
	}
}
