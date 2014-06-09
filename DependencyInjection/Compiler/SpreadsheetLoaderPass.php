<?php

namespace Akeneo\Bundle\SpreadsheetParserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Adds tagged services to the global Spreadsheet Loader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetLoaderPass implements CompilerPassInterface
{
    /**
     * @staticvar string The name of the tag
     */
    const TAG_NAME = 'akeneo_spreadsheet_parser.spreadsheet_loader';

    /**
     * @staticvar string The id of the global loader service
     */
    const SERVICE_ID = 'akeneo_spreadsheet_parser.spreadsheet_loader';

    public function process(ContainerBuilder $container)
    {
        $globalService = $container->getDefinition(static::SERVICE_ID);

        foreach ($container->findTaggedServiceIds(static::TAG_NAME) as $serviceId => $tags) {
            foreach ($tags as $tag) {
                $globalService->addMethodCall(
                    'addLoader',
                    [$tag['alias'], new Reference($serviceId)]
                );
            }
        }
    }
}
