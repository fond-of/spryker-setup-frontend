<?php

namespace FondOfSpryker\Shared\SetupFrontend;

use Spryker\Shared\SetupFrontend\SetupFrontendConstants as SprykerSetupFrontendConstants;

interface SetupFrontendConstants extends SprykerSetupFrontendConstants
{
    public const ARGUMENT_THEME = 'theme';

    public const OPTION_FORCE = 'force';

    public const THEME_BUILD_CHOICE = 'No template name given, generate all?';

    public const THEME_BUILD_CHOICE_NO = 'no';

    public const THEME_BUILD_CHOICE_YES = 'yes';

    public const YVES_THEMES = 'yves_themes';

    public const FRONTEND_BUILD_MODE = 'FRONTEND_BUILD_MODE';
}
