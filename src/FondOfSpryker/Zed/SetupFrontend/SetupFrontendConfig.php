<?php

namespace FondOfSpryker\Zed\SetupFrontend;

use FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants;
use Spryker\Zed\SetupFrontend\SetupFrontendConfig as SprykerSetupFrontendConfig;

class SetupFrontendConfig extends SprykerSetupFrontendConfig
{
    public function getThemes()
    {
        return $this->get(SetupFrontendConstants::YVES_THEMES, false);
    }
}
