<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of environment variables.
 *
 * Executes the official Apify API operation act_version_envVars_get.
 */
class ApifyActVersionEnvVarsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_version_env_vars_get';
}
