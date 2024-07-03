<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Acervosalesiano
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Acervosalesiano\Component\Acervosalesiano\Administrator\Extension\AcervosalesianoComponent;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;


/**
 * The Acervosalesiano service provider.
 *
 * @since  1.0.0
 */
return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function register(Container $container)
	{

		$container->registerServiceProvider(new CategoryFactory('\\Acervosalesiano\\Component\\Acervosalesiano'));
		$container->registerServiceProvider(new MVCFactory('\\Acervosalesiano\\Component\\Acervosalesiano'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\Acervosalesiano\\Component\\Acervosalesiano'));
		$container->registerServiceProvider(new RouterFactory('\\Acervosalesiano\\Component\\Acervosalesiano'));

		$container->set(
			ComponentInterface::class,
			function (Container $container)
			{
				$component = new AcervosalesianoComponent($container->get(ComponentDispatcherFactoryInterface::class));

				$component->setRegistry($container->get(Registry::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));
				$component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
				$component->setRouterFactory($container->get(RouterFactoryInterface::class));

				return $component;
			}
		);
	}
};
