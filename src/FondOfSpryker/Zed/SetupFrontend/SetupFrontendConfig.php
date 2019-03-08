<?php

namespace FondOfSpryker\Zed\SetupFrontend;

use FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants;
use Spryker\Zed\SetupFrontend\SetupFrontendConfig as SprykerSetupFrontendConfig;

class SetupFrontendConfig extends SprykerSetupFrontendConfig
{
    /**
     * @return mixed
     */
    public function getThemes()
    {
        return $this->get(SetupFrontendConstants::YVES_THEMES, false);
    }

    /**
     * @return string
     */
    public function getYvesBuildCommand(): string
    {
        return 'npm run yves' . $this->getBuildMode();
    }

    /**
     * @return string
     */
    public function getZedBuildCommand(): string
    {
        return 'npm run zed' . $this->getBuildMode();
    }

    /**
     * @return string|null
     */
    protected function getBuildMode(): ?string
    {
        $mode = $this->get(SetupFrontendConstants::FRONTEND_BUILD_MODE, '');

        return ($mode) ? ':' . $mode : null;
    }
}
