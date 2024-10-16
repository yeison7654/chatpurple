<?php

class Mysql extends Conexion
{
	private $conexion;
	private $strquery;
	private $arrValues;

	function __construct()
	{
		$this->conexion = new Conexion();
		$this->conexion = $this->conexion->conect();
	}

	//Insertar un registro
	public function insert(string $query, array $arrValues)
	{
		try {
			$this->strquery = $query;
			$this->arrValues = $arrValues;
			$insert = $this->conexion->prepare($this->strquery);
			$resInsert = $insert->execute($this->arrValues);
			if ($resInsert) {
				$lastInsert = $this->conexion->lastInsertId();
			} else {
				$lastInsert = 0;
			}
			return $lastInsert;
		} catch (PDOException $error) {
			$data = array(
				"title" => "Ocurrio un error inesperado",
				"description" => $error->getMessage(),
				"status" => false,
				"datetime" => date("Y-m-d H:i:s"),
			);
			echo json_encode($data);
			die();
		}
	}
	//Busca un registro
	public function select(string $query, array $arrValues = array())
	{
		try {
			$this->strquery = $query;
			$this->arrValues = $arrValues;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute($this->arrValues);
			$data = $result->fetch(PDO::FETCH_ASSOC);
			return $data;
		} catch (PDOException $error) {
			$data = array(
				"title" => "Ocurrio un error inesperado",
				"description" => $error->getMessage(),
				"status" => false,
				"datetime" => date("Y-m-d H:i:s"),
			);
			echo json_encode($data);
			die();
		}
	}
	//Devuelve todos los registros
	public function select_all(string $query)
	{
		try {
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetchall(PDO::FETCH_ASSOC);
			return $data;
		} catch (PDOException $error) {
			$data = array(
				"title" => "Ocurrio un error inesperado",
				"description" => $error->getMessage(),
				"status" => false,
				"datetime" => date("Y-m-d H:i:s"),
			);
			echo json_encode($data);
			die();
		}
	}
	//Actualiza registros
	public function update(string $query, array $arrValues)
	{
		$this->strquery = $query;
		$this->arrVAlues = $arrValues;
		$update = $this->conexion->prepare($this->strquery);
		$resExecute = $update->execute($this->arrVAlues);
		return $resExecute;
	}
	//Eliminar un registros
	public function delete(string $query)
	{
		$this->strquery = $query;
		$result = $this->conexion->prepare($this->strquery);
		$del = $result->execute();
		return $del;
	}
}
