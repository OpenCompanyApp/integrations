<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Get the authenticated Buildkite user.
 */
class BuildkiteGetCurrentUser extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_get_current_user';
    protected const DESCRIPTION = 'Get the authenticated Buildkite user for the configured access token.';
    protected const METHOD = 'getCurrentUser';
}
