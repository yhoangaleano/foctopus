<?php
	class Song extends Controller
	{
		public $modelSong = null;

		function __construct()
		{
			$this->modelSong = $this->loadModel("modelSong");
		}

		public function index(){
			$this->render('index');
		}

		public function getAllSong()
		{
			$result = $this->modelSong->getAllSong();
			echo json_encode($result);
		}

		public function create()
		{
			$this->render('create');
		}

		public function addSong()
		{
			if (isset($_POST["action"])) {
				$this->modelSong->__SET('artist', $_POST["txtArtist"]);
				$this->modelSong->__SET('track', $_POST["txtTrack"]);
				$this->modelSong->__SET('link', $_POST["txtLink"]);
				$result = $this->modelSong->addSong();
				echo json_encode(array('result' => $result));
				return;
			}
			echo json_encode(array('result' => false));
		}

		public function edit($id)
		{
			if (!is_null($id)) {
				$this->modelSong->__SET('id', $_POST["txtId"]);
				$song = $this->modelSong->getSong();
				$this->render('edit');
			} else {
				header('location: ' . URL . 'songs/index');
			}
		}

		public function getSong()
		{
				$this->modelSong->__SET('id', $_POST["txtId"]);
				$song = $this->modelSong->getSong();
				echo json_encode(array('result' => $song));
		}

	}
?>