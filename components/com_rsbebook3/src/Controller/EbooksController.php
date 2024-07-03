<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Rsbebook
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Rsbebook\Component\Rsbebook\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Utilities\ArrayHelper;

/**
 * Ebooks class.
 *
 * @since  1.0.0
 */
class EbooksController extends FormController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return  object	The model
	 *
	 * @since   1.0.0
	 */
	public function getModel($name = 'Ebooks', $prefix = 'Site', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => true));
	}

	// Método para buscar termos
    public static function getTermos($id):array {
        $db = Factory::getDbo();

        $query = $db->getQuery(true);

        // Selecionando os dados dos artigos referentes a categoria de termos. id 32
        $query->select(array('*'));
        $query->from($db->quoteName('#__content'));
        $query->where($db->quoteName('catid') . ' = '.$db->quote(32));
        $query->where($db->quoteName('id') . ' = '.$db->quote($id));
        $query->order($db->quoteName('ordering') . ' ASC');

        $db->setQuery($query);

        // Trazendo os dados do banco.
        try {
            return $results = $db->loadObjectList();
        } catch (Exception $e) {
            return $e->getMessage(); // Retorna a mensagem de erro
        }
    }

    public function ajaxAction(){
        
        $dados = array();
        
        /// Obtenha os dados POST enviados pelo fetch
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $dados['consentimentoDeUso'] = self::getTermos(8563)[0];
        $dados['ebookid'] = $input;

        echo json_encode($dados);
        exit();
    }
}
