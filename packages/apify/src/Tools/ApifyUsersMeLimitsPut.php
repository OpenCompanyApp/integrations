<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update limits.
 *
 * Executes the official Apify API operation users_me_limits_put.
 */
class ApifyUsersMeLimitsPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_users_me_limits_put';
}
