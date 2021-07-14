<?php
    class Database{
        protected $servername;
        protected $username;
        protected $password;
        protected $dbname;
        protected $conn;
        public function __construct($servername = "localhost", $username = "gau", $password = "gau123456", $dbname="products")
        {
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
            $this->conn = new mysqli($servername, $username, $password, $dbname);
			
        }
		
		public function get_prods($query)
		{
			$prods = [];
			
			$res = $this->conn->query($query);
			
			if ($res->num_rows > 0){
				while ($row = $res->fetch_assoc()){
					$prods[] = $row;
				}
			}
			return $prods;

		}
		
		public function get_all()
		{
			$products = [];
			// DVD
			$query = "SELECT id, SKU, p_name, concat(price,'$'), concat(p_size,' ',	'MB') AS Size FROM product WHERE p_size is not NULL";
			$products[] = $this->get_prods($query);
			// Book
			$query = "SELECT id, SKU, p_name, concat(price,'$'), concat(p_weight,' ', 'KG') AS 'Weight' FROM product WHERE p_weight is not NULL";
			$products[] = $this->get_prods($query);
			// Furniture
			$query = "SELECT id, SKU, p_name, concat(price,'$'), concat(height,'x',width,'x',p_length) as Dimensions FROM product WHERE height is not NULL AND
			width is not NULL AND p_length is not NULL";
			$products[] = $this->get_prods($query);
			return $products;	
		
		}
		public function insert_product($post_data){
			$post_data['SKU'] = strtoupper($post_data['SKU']);
			unset($post_data['submit']);
			$query = "INSERT INTO product VALUES(NULL";
			foreach($post_data as $d){
				$v = empty($d) ? ", NULL" : ", '$d'";
				$query .= $v;
			}
			$query .= ")";
			$this->conn->query($query);

		}
		
		public function delete_product($id){
			$query = "DELETE FROM product WHERE id = '$id'";
			$this->conn->query($query);
		}
		public function close(){
		    $this->conn->close();
		}
		
    }