<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }

    //realiza alterações e consultas na tabela variaveis
    class Variaveis_model extends CI_Model{

        /**
         * Método contrutor
         */
        public function __construct() {

            parent::__construct();
            $this->load->model('Variaveis_model','vm');
        }
        //pega todos os variaveis cadastrados no sistema
		public function GetAllVariaveis() {

            $this->db->select('*');
            $this->db->from('variavel');

            return $this->db->get()->result();
        }

        //adiciona variavel no sistema
        public function AddVariavel($dados_variavel = NULL) {

            return $this->db->insert('variavel', $dados_variavel);
        }
        //pega variavel no sistema pelo seu ID
        public function GetVariavelById($idVariavel = NULL) {

            $this->db->select('*');
            $this->db->from('variavel');
            $this->db->where('idVariavel', $idVariavel);

            return $this->db->get()->result()[0];
        }

        public function GetIdVariavelByName($nmVariavel = NULL){

            $this->db->select('*');
            $this->db->from('variavel');
            $this->db->where('nmVariavel', $nmVariavel);

            return $this->db->get()->result()[0];            
        }

        public function AddValor($dados_valor = NULL) {

            return $this->db->insert('valor', $dados_valor);
        }

        public function GetAllValores() {

            $this->db->select('*');
            $this->db->from('valor');

            return $this->db->get()->result();
        }

        public function GetValoresByIdVariavel($idVariavel = NULL){
            
            $this->db->select('*');
            $this->db->from('valor');
            $this->db->where('idVariavel', $idVariavel); 

            return $this->db->get()->result();          
        }

        public function VerifyVariavel($nmVariavel = NULL, $idVariavel = NULL){

            $this->db->select('*');
            $this->db->from('variavel');
            $this->db->where('nmVariavel', $nmVariavel);
			$this->db->where('idVariavel !=', $idVariavel);
            $query = $this->db->get();
            if($query->num_rows() > 0)
                return true;
            else 
                return false; 
        }

        /*public function verifica_variavel($variavel, $usuario){
            $this->load->database();
            $query = $this->db->get_where('usuario', array('nmLogin !=' => $login, 'nmUsuario' => $usuario ));
            $result = $query->result_array();
            if(count($result) > 0) {
                return TRUE;
            }
            return FALSE;
        }
        //verifica se existe usuario que já foi cadastrado através do nome

        public function verifica_cadastrado_alterar_nome($id,$nome){
            $this->load->database();
            $query = $this->db->get_where('usuario', array('idUsuario !=' => $id, 'nmUsuario' => $nome ));
            $result = $query->result_array();
            if(count($result) > 0) {
                return TRUE;
            }
            return FALSE;
        }
          //verifica se existe usuario que já foi cadastrado através do email
         public function verifica_cadastrado_alterar_email($id,$email){
            $this->load->database();
            $query = $this->db->get_where('usuario', array('idUsuario !=' => $id, 'email' => $email ));
            $result = $query->result_array();
            if(count($result) > 0) {
                return TRUE;
            }
            return FALSE;
        }
          //verifica se existe usuario que já foi cadastrado através do login
         public function verifica_cadastrado_alterar_login($id,$login){
            $this->load->database();
            $query = $this->db->get_where('usuario', array('idUsuario !=' => $id, 'nmLogin' => $login ));
            $result = $query->result_array();
            if(count($result) > 0) {
                return TRUE;
            }
            return FALSE;
        }*/
        //atualiza dados de uma variavel
        public function UpdateVariavel($idVariavel = NULL, $dados_variavel = NULL) {

            $this->db->where('idVariavel', $idVariavel);
            $this->db->update('variavel', $dados_variavel);

            return TRUE;
        }
		
        public function UpdateValor($idValor = NULL, $dados_valor = NULL) {

            $this->db->where('idValor', $idValor);
            $this->db->update('valor', $dados_valor);

            return TRUE;
        }
		
        //deleta variavel do sistema
        public function DeleteVariavel($idVariavel = NULL) {

            $this->db->where('idVariavel', $idVariavel);
            $this->db->delete('variavel');

            return TRUE;
        }

        public function DeleteValores($idVariavel = NULL) {

            $this->db->where('idVariavel', $idVariavel);
            $this->db->delete('valor');

            return TRUE;
        }

        public function DeleteValor($idValor = NULL) {

            $this->db->where('idValor', $idValor);
            $this->db->delete('valor');

            return TRUE;
        }
    }
