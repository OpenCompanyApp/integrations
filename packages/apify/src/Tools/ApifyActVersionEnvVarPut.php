<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update environment variable.
 *
 * Executes the official Apify API operation act_version_envVar_put.
 */
class ApifyActVersionEnvVarPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_version_env_var_put';
}
