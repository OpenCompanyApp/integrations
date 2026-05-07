<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get limits.
 *
 * Executes the official Apify API operation users_me_limits_get.
 */
class ApifyUsersMeLimitsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_users_me_limits_get';
}
