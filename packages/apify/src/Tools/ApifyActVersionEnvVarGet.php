<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get environment variable.
 *
 * Executes the official Apify API operation act_version_envVar_get.
 */
class ApifyActVersionEnvVarGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_version_env_var_get';
}
