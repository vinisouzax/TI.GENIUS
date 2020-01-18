<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }

    //realiza alterações e consultas na tabela categorias
    class Categorias_model extends CI_Model{

        /**
         * Método contrutor
         */
        public function __construct() {

            parent::__construct();
            $this->load->model('Categorias_model','cm');
        }
        //pega todos as categorias cadastrados no sistema
		public function GetAllCategorias() {

            $this->db->select('*');
            $this->db->from('categoria');

            return $this->db->get()->result();
        }

        //adiciona categoria no sistema
        public function AddCategoria($dados_categoria = NULL) {

            return $this->db->insert('categoria', $dados_categoria);
        }
        //pega categoria no sistema pelo seu ID
        public function GetCategoriaById($idCategoria = NULL) {

            $this->db->select('*');
            $this->db->from('categoria');
            $this->db->where('idCategoria', $idCategoria);

            return $this->db->get()->result()[0];
        }

        public function VerifyCategoria($nmCategoria = NULL, $idCategoria = NULL){

            $this->db->select('*');
            $this->db->from('categoria');
            $this->db->where('nmCategoria', $nmCategoria);
			$this->db->where('idCategoria !=', $idCategoria);

            $query = $this->db->get();
            if($query->num_rows() > 0)
                return true;
            else 
                return false; 
        }

        //atualiza dados de uma categoria
        public function UpdateCategoria($idCategoria = NULL, $dados_categoria = NULL) {

            $this->db->where('idCategoria', $idCategoria);
            $this->db->update('categoria', $dados_categoria);

            return TRUE;
        }
		
        //deleta categoria do sistema
        public function DeleteCategoria($idCategoria = NULL) {

            $this->db->where('idCategoria', $idCategoria);
            $this->db->delete('categoria');

            return TRUE;
        }

    }
