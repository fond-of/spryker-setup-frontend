<?php

namespace FondOfSpryker\Zed\SetupFrontend\Communication\Console;

use Spryker\Zed\SetupFrontend\Communication\Console\YvesBuildFrontendConsole as SprykerYvesBuildFrontendConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class YvesBuildFrontendConsole
 * @package FondOfSpryker\Zed\SetupFrontend\Communication\Console
 * @method \FondOfSpryker\Zed\SetupFrontend\Business\SetupFrontendFacade getFacade()
 */
class YvesBuildFrontendConsole extends SprykerYvesBuildFrontendConsole
{
    const ARGUMENT_THEME_NAME = 'themeName';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);
        $this->addArgument(static::ARGUMENT_THEME_NAME, InputArgument::REQUIRED, 'use value from config $YVES_THEME');

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $this->info(sprintf('Build Yves frontend: %s', $input->getArgument(static::ARGUMENT_THEME_NAME)));

        if ($this->getFacade()->buildYvesFrontend($this->getMessenger())) {
            return static::CODE_SUCCESS;
        }

        return static::CODE_ERROR;
    }
}
