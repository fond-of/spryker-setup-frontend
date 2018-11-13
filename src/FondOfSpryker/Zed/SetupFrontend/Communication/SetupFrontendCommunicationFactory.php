<?php

namespace FondOfSpryker\Zed\SetupFrontend\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @method \FondOfSpryker\Zed\SetupFrontend\SetupFrontendConfig getConfig()
 */
class SetupFrontendCommunicationFactory extends AbstractCommunicationFactory
{
    public function createFilesystemComponent(): Filesystem
    {
        return new Filesystem();
    }
}
