<?php

namespace FondOfSpryker\Zed\SetupFrontend\Communication\Console;

use FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants;
use Spryker\Zed\SetupFrontend\Communication\Console\YvesBuildFrontendConsole as SprykerYvesBuildFrontendConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\SetupFrontend\Business\SetupFrontendFacade getFacade()
 * @method \FondOfSpryker\Zed\SetupFrontend\Communication\SetupFrontendCommunicationFactory getFactory()
 */
class YvesBuildFrontendConsole extends SprykerYvesBuildFrontendConsole
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription(self::DESCRIPTION)
            ->addArgument(SetupFrontendConstants::ARGUMENT_THEME, null, InputArgument::REQUIRED);

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
        $this->validateTheme($input->getArgument(SetupFrontendConstants::ARGUMENT_THEME));
        $this->info(sprintf('Build Yves frontend: %s', $input->getArgument(SetupFrontendConstants::ARGUMENT_THEME)));

        if ($this->getFacade()->buildYvesFrontend(
            $this->getMessenger(),
            [SetupFrontendConstants::ARGUMENT_THEME => $input->getArgument(SetupFrontendConstants::ARGUMENT_THEME)]
        )) {
            return static::CODE_SUCCESS;
        }

        return static::CODE_ERROR;
    }

    /**
     * @param string $mode
     *
     * @return ?bool
     */
    protected function validateTheme($theme): ?bool
    {
        $fs = $this->getFactory()->createFilesystemComponent();

        if ($theme === null) {
            $this->error('No Theme-Name given: frontend:yves:build yourTheme');
            exit;
        }

        if (!$fs->exists('./frontend/' . strtolower($theme))) {
            $this->error(sprintf('Themefolder for "%s" not found in %s', $theme, './frontend/' . strtolower($theme)));
            exit;
        }

        return true;
    }
}
