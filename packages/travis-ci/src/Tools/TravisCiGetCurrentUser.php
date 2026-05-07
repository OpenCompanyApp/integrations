<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Get the authenticated Travis CI user.
 */
class TravisCiGetCurrentUser extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_get_current_user';
    protected const DESCRIPTION = 'Get the authenticated Travis CI user for the configured API token.';
    protected const METHOD = 'getCurrentUser';
}
