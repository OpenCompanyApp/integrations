<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete environment variable.
 *
 * Executes the official Apify API operation act_version_envVar_delete.
 */
class ApifyActVersionEnvVarDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_version_env_var_delete';
}
