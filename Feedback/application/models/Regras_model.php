<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }

    //realiza alterações e consultas na tabela variaveis
    class Regras_model extends CI_Model{

        /**
         * Método contrutor
         */
        public function __construct() {

            parent::__construct();
            $this->load->model('Variaveis_model','vm');
            $this->load->model('Variaveis_model','rm');
        }
        //pega todos os regras cadastrados no sistema
		public function GetAllRegras() {

            $this->db->select('*');
            $this->db->from('regra');

            return $this->db->get()->result();
        }

        public function GetAllRegrasXVariaveis() {

            $this->db->select('*');
            $this->db->from('regraxvariavel');

            return $this->db->get()->result();
        }
        //adiciona regra no sistema
        public function AddRegra($dados_regra = NULL) {

            return $this->db->insert('regra', $dados_regra);
        }
        //pega regra no sistema pelo seu ID
        public function GetRegraById($idRegra = NULL) {

            $this->db->select('*');
            $this->db->from('regra');
            $this->db->where('idRegra', $idRegra);

            return $this->db->get()->result()[0];
        }
        //pega regra pelo seu nome
        public function GetIdRegraByName($nmRegra = NULL){

            $this->db->select('*');
            $this->db->from('regra');
            $this->db->where('nmRegra', $nmRegra);

            return $this->db->get()->result()[0];            
        }
        //realiza a ligação entre regras e variaveis em uma tabela auxiliar
        public function AddRegraXVariavel($dados_regra = NULL) {

            return $this->db->insert('regraxvariavel', $dados_regra);
        }
        //verifica se regra existe
        public function VerifyRegra($nmRegra = NULL, $idRegra = NULL){

            $this->db->select('*');
            $this->db->from('regra');
            $this->db->where('nmRegra', $nmRegra);
			$this->db->where('idRegra !=', $idRegra);

            $query = $this->db->get();
            if($query->num_rows() > 0)
                return true;
            else 
                return false; 
        }

        //atualiza dados de uma regra
        public function UpdateRegra($idRegra = NULL, $dados_regra = NULL) {

            $this->db->where('idRegra', $idRegra);
            $this->db->update('regra', $dados_regra);

            return TRUE;
        }
        //atualiza uma ligação entre regra e variavel
        public function UpdateRegraXVariavel($idRegraXVariavel = NULL, $dados_regraxvariavel = NULL) {

            $this->db->where('idRegraXVariavel', $idRegraXVariavel);
            $this->db->update('regraxvariavel', $dados_regraxvariavel);

            return TRUE;
        }
		
        //deleta regra do sistema
        public function DeleteRegra($idRegra = NULL) {

            $this->db->where('idRegra', $idRegra);
            $this->db->delete('regra');

            return TRUE;
        }
        //deleta todas as ligações entre a regra e a variavel construidas, a partir de uma regra deletada
        public function DeleteRegrasXVariaveis($idRegra = NULL) {

            $this->db->where('idRegra', $idRegra);
            $this->db->delete('regraxvariavel');

            return TRUE;
        }
        //deletea apenas uma ligação entre regra e variavel
        public function DeleteRegraXVariavel($idRegraXVariavel = NULL) {

            $this->db->where('idRegraXVariavel', $idRegraXVariavel);
            $this->db->delete('regraxvariavel');

            return TRUE;
        }
        //pega todas as regras que estão ligadas a uma variavel
        public function GetRegrasByIdVariavel($idVariavel = NULL) {

            $this->db->select('*');
            $this->db->from('regraxvariavel');
            $this->db->where('idVariavel', $idVariavel);

            return $this->db->get()->result();
        }
        //pega todas as regras ligadas a uma categoria
        public function GetRegrasByIdCategoria($idCategoria = NULL) {

            $this->db->select('*');
            $this->db->from('regra');
            $this->db->where('idCategoria', $idCategoria);

            return $this->db->get()->result();
        }
    }
