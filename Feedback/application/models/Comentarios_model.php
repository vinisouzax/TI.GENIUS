<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }

    //realiza alterações e consultas na tabela variaveis
    class Comentarios_model extends CI_Model{

        /**
         * Método contrutor
         */
        public function __construct() {

            parent::__construct();
        }
        public function AddComentario($dados_comentario = NULL) {

            return $this->db->insert('comentario', $dados_comentario);
        }

    }
