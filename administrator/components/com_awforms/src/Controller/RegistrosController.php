<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Awforms
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Awforms\Component\Awforms\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Utilities\ArrayHelper;

/**
 * Registros list controller class.
 *
 * @since  1.0.0
 */
class RegistrosController extends AdminController
{
	/**
	 * Method to clone existing Registros
	 *
	 * @return  void
	 *
	 * @throws  Exception
	 */
	public function duplicate()
	{
		// Check for request forgeries
		$this->checkToken();

		// Get id(s)
		$pks = $this->input->post->get('cid', array(), 'array');

		try
		{
			if (empty($pks))
			{
				throw new \Exception(Text::_('COM_AWFORMS_NO_ELEMENT_SELECTED'));
			}

			ArrayHelper::toInteger($pks);
			$model = $this->getModel();
			$model->duplicate($pks);
			$this->setMessage(Text::_('COM_AWFORMS_ITEMS_SUCCESS_DUPLICATED'));
		}
		catch (\Exception $e)
		{
			Factory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
		}

		$this->setRedirect('index.php?option=com_awforms&view=registros');
	}

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    Optional. Model name
	 * @param   string  $prefix  Optional. Class prefix
	 * @param   array   $config  Optional. Configuration array for model
	 *
	 * @return  object	The Model
	 *
	 * @since   1.0.0
	 */
	public function getModel($name = 'Registro', $prefix = 'Administrator', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => true));
	}

	

	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 *
	 * @throws  Exception
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$pks   = $this->input->post->get('cid', array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');

		// Sanitize the input
		ArrayHelper::toInteger($pks);
		ArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		Factory::getApplication()->close();
	}

	function exportar_para_csv() {
		$model = $this->getModel('Registros');

		//Dados do formulário que vem dos módulos, dos parametros.
		$dadosForm = json_decode($model->getDados())->fields;

		//Dados do banco de dados onde inserimos os dados do formulário.
		$dados = (array) json_decode(json_encode($model->getItems()), true);
		
		//Chaves do primeiro registro
		$cabecalho = array_keys($dados[0]);

		//Criando os dados chave e valor para pegar as labels dos dados do formulário módulo.
		$dadosFormArray = [];
		foreach($dadosForm as $v):
			if(!preg_match('/\[[^\]]*\]/', $v->attrs->name) and !$v->config->hideLabel):
				$dadosFormArray[$v->attrs->name] =  utf8_decode($v->config->label);
			endif;
		endforeach;

		//Convertendo os dados das chaves normais do banco pelas Labels do formulário do modulo.
		$cabecalho = array_map(function($item) use($dadosFormArray){
			return $dadosFormArray[$item] ?? $item;
		},$cabecalho);
		
		// Nome do arquivo CSV
		$nome_arquivo = $_SESSION['table_aw'].'.csv';
	
		// Abrir o buffer de saída
		ob_start();
	
		// Abrir o arquivo CSV em modo de escrita
		$arquivo_csv = fopen('php://output', 'w');
	
		// Escrever os cabeçalhos, se existirem
		if (!empty($dados)) {
			fputcsv($arquivo_csv, $cabecalho, ';');
		}
	
		// Escrever os dados
		foreach ($dados as $linha) {
			$linha =  array_map('utf8_decode', $linha);
			fputcsv($arquivo_csv, $linha, ';');
		}
	
		// Fechar o arquivo
		fclose($arquivo_csv);
	
		// Obter o conteúdo do buffer de saída
		$conteudo_csv = ob_get_clean();
	
		// Enviar os cabeçalhos HTTP para forçar o download do arquivo CSV
		header('Content-Type: text/csv; charset=ANSI');
		header('Content-Disposition: attachment; filename="' . $nome_arquivo . '"');
		
		// Enviar o conteúdo do arquivo CSV para o navegador
		echo $conteudo_csv;
	
		// Encerrar a execução do script
		exit;
	}
	
}
