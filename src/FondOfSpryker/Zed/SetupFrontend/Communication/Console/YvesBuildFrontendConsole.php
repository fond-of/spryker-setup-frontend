<?php

namespace FondOfSpryker\Zed\SetupFrontend\Communication\Console;

use FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants;
use Spryker\Zed\SetupFrontend\Communication\Console\YvesBuildFrontendConsole as SprykerYvesBuildFrontendConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addArgument(SetupFrontendConstants::ARGUMENT_THEME, null, InputArgument::OPTIONAL)
            ->addOption(SetupFrontendConstants::OPTION_FORCE, null, InputOption::VALUE_OPTIONAL, '', false);

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return bool
     */
    protected function confirmBuildAll(InputInterface $input, OutputInterface $output): bool
    {
        $helper = $this->getHelper('question');
        $question = $this->getFactory()->createConfirmationBuildAllTemplates();
        $answer = $helper->ask($input, $output, $question);

        return ($answer == SetupFrontendConstants::THEME_BUILD_CHOICE_YES) ? true : false;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return array
     */
    protected function getThemes(InputInterface $input, OutputInterface $output): array
    {
        $themes = $this->getFactory()->getThemes();

        if (!$input->getArgument(SetupFrontendConstants::ARGUMENT_THEME) && $input->getOption(SetupFrontendConstants::OPTION_FORCE) === false) {
            if ($this->confirmBuildAll($input, $output) === false) {
                exit;
            }

            return $themes;
        } elseif ($input->getOption(SetupFrontendConstants::OPTION_FORCE) === null) {
            return $themes;
        } else {
            return [$input->getArgument(SetupFrontendConstants::ARGUMENT_THEME)];
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $themes = $this->getThemes($input, $output);

        if ($this->validateTheme($themes) === false) {
            return static::CODE_ERROR;
        }

        foreach ($themes as $theme) {
            $this->info(sprintf('Build Yves frontend: %s', $theme));

            if ($this->getFacade()->buildYvesFrontend(
                $this->getMessenger(),
                [SetupFrontendConstants::ARGUMENT_THEME => $theme]
            )) {
                $this->success(sprintf('Theme for "%s" created successfully', $theme));
                continue;
            }

            return static::CODE_ERROR;
        }

        return static::CODE_SUCCESS;
    }

    /**
     * @param string|array $mode
     *
     * @return ?bool|null
     */
    protected function validateTheme(array $themes): ?bool
    {
        $fs = $this->getFactory()->createFilesystemComponent();
        $errCount = 0;

        foreach ($themes as $theme) {
            if ($theme === null) {
                $this->error('No Theme-Name given: frontend:yves:build yourTheme');
                $errCount++;
            }

            if (!$fs->exists('./frontend/' . strtolower($theme))) {
                $this->error(sprintf('Themefolder for "%s" not found in %s', $theme, './frontend/' . strtolower($theme)));
                $errCount++;
            }
        }

        return ($errCount === 0) ? true : false;
    }
}
