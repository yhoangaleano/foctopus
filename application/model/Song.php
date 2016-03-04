<?php
class song
{

	private $id;
	private $artist;
	private $track;
	private $link;

	public function __GET($key)
	{
		return $this->$key;
	}

	public function __SET($key, $value)
	{
		$this->$key = $value;
	}

	/**
	* @param object $db Conexión a PDO con la configuración establecida
	*/
	function __construct($db)
	{
		try {
			$this->db = $db;
		}
		catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	public function getAllSong()
	{
		$sql = "SELECT id, artist, track, link FROM song";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function addSong()
	{
		$sql = "INSERT INTO song (artist, track, link ) VALUES (:artist, :track, :link)";
		$query = $this->db->prepare($sql);
		$parameters = array(
			 ':artist' => strip_tags($this->__GET("artist")),  ':track' => strip_tags($this->__GET("track")),  ':link' => strip_tags($this->__GET("link"))
		);
		$validate = false;
		$query->execute($parameters);
		if ($query->rowCount() > 0) {
			$validate = true;
		}
		return $validate;
	}

	public function deleteSong()
	{
		$sql = "DELETE FROM song WHERE id = :id";
		$query = $this->db->prepare($sql);
		$parameters = array(
			':id' => strip_tags($this->__GET("id"))
		);

		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

		$validate = false;
		$query->execute($parameters);

		if ($query->rowCount() > 0) {
			$validate = true;
		}

		return $validate;
	}

	public function getSong()
	{
		$sql = "SELECT id, artist, track, link FROM song WHERE id = :id";
		$query = $this->db->prepare($sql);
		$parameters = array(
			':id' => strip_tags($this->__GET("id"))
		);

		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
		$query->execute($parameters);
		// fetch() is the PDO method that get exactly one result
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}
?>