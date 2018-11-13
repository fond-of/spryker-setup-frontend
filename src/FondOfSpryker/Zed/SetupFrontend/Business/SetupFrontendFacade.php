<?php

namespace FondOfSpryker\Zed\SetupFrontend\Business;

use Psr\Log\LoggerInterface;
use Spryker\Zed\SetupFrontend\Business\SetupFrontendFacade as SprykerSetupFrontendFacade;

/**
 * @method \FondOfSpryker\Zed\SetupFrontend\SetupFrontendConfig getConfig()
 * @method \FondOfSpryker\Zed\SetupFrontend\Business\SetupFrontendBusinessFactory getFactory()
 */
class SetupFrontendFacade extends SprykerSetupFrontendFacade
{
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array $arguments
     * @param array $options
     *
     * @return bool
     */
    public function buildYvesFrontend(LoggerInterface $logger, array $params = []): bool
    {
        return $this->getFactory()->createYvesBuilderExtendTheme($params)->build($logger);
    }
}
