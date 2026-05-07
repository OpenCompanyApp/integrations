<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last Actor run's log.
 *
 * Executes the official Apify API operation act_runs_last_log_get.
 */
class ApifyActRunsLastLogGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_log_get';
}
