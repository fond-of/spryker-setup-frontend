<?php

namespace FondOfSpryker\Zed\SetupFrontend\Business;

use Exception;
use FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants;
use Spryker\Zed\SetupFrontend\Business\Model\Builder\Builder;
use Spryker\Zed\SetupFrontend\Business\SetupFrontendBusinessFactory as SprykerSetupFrontendBusinessFactory;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @method \FondOfSpryker\Zed\SetupFrontend\SetupFrontendConfig getConfig()
 */
class SetupFrontendBusinessFactory extends SprykerSetupFrontendBusinessFactory
{
    /**
     * @return \Spryker\Zed\SetupFrontend\Business\Model\Builder\BuilderInterface
     */
    public function createYvesBuilderExtendTheme(array $params)
    {
        return new Builder($this->getConfig()->getYvesBuildCommand() . ' ' . $this->getThemeName($params));
    }

    /**
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    public function createFilesystemComponent(): Filesystem
    {
        return new Filesystem();
    }

    /***
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return null|string
     */
    protected function getThemeName(array $arguments): ?string
    {
        if (!array_key_exists(SetupFrontendConstants::ARGUMENT_THEME, $arguments)) {
            throw new Exception('No theme given');
        }

        return $arguments[SetupFrontendConstants::ARGUMENT_THEME];
    }
}
