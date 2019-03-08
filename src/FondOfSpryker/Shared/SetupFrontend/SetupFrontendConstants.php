<?php

namespace FondOfSpryker\Shared\SetupFrontend;

use Spryker\Shared\SetupFrontend\SetupFrontendConstants as SprykerSetupFrontendConstants;

interface SetupFrontendConstants extends SprykerSetupFrontendConstants
{
    const ARGUMENT_THEME = 'theme';

    const OPTION_FORCE = 'force';

    const THEME_BUILD_CHOICE = 'No template name given, generate all?';

    const THEME_BUILD_CHOICE_NO = 'no';

    const THEME_BUILD_CHOICE_YES = 'yes';

    const YVES_THEMES = 'yves_themes';

    const FRONTEND_BUILD_MODE = 'FRONTEND_BUILD_MODE';
}
