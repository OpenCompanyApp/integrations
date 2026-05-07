<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get monthly usage.
 *
 * Executes the official Apify API operation users_me_usage_monthly_get.
 */
class ApifyUsersMeUsageMonthlyGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_users_me_usage_monthly_get';
}
