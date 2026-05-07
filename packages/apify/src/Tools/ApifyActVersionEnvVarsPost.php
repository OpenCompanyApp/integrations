<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Create environment variable.
 *
 * Executes the official Apify API operation act_version_envVars_post.
 */
class ApifyActVersionEnvVarsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_version_env_vars_post';
}
