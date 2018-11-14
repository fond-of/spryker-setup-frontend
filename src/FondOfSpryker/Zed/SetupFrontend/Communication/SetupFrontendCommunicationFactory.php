<?php

namespace FondOfSpryker\Zed\SetupFrontend\Communication;

use FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Console\Question\ChoiceQuestion;
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

    public function createConfirmationBuildAllTemplates(): ChoiceQuestion
    {
        return new ChoiceQuestion(SetupFrontendConstants::THEME_BUILD_CHOICE, [
        SetupFrontendConstants::THEME_BUILD_CHOICE_NO,
        SetupFrontendConstants::THEME_BUILD_CHOICE_YES,
        ], 0);
    }

    /**
     * @return array
     */
    public function getThemes()
    {
        return $this->getConfig()->getThemes();
    }
}
