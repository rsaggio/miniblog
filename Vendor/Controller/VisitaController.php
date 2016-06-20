<?php
namespace Vendor\Controller;

use Vendor\Model\{Postagem,Usuario};
use Vendor\DAO\{PostagemDAO,UsuarioDAO};
use Vendor\Model\{Noticia,Login};
use Vendor\Factory\ConnectionFactory;
use Vendor\Lib\View;

class VisitaController{
	private $postagemDao;
	private $usuarioDao;

	public function __construct(){
		$con = ConnectionFactory::getConnection();
		$this->postagemDao = new PostagemDAO($con);
		$this->usuarioDao = new UsuarioDAO($con);
	}


public function visita(){
		$view = new View('index','Visita');
			$usuario = $this->usuarioDao->buscaPorId($_GET["usuarioId"]);
			$usuarioLogado = Login::usuarioEstaLogado();
			$postagens = $this->postagemDao->lista($usuario->getId());
			$postsPorSemana = $this->postagemDao->postsPorSemana($usuario->getId());
			
			$view->itens('postagens',$postagens);
			$view->itens('postsPorSemana',$postsPorSemana);
			$view->itens('usuario',$usuario);
			$view->itens('usuarioLogado',$usuarioLogado);

			return $view;
	}
}