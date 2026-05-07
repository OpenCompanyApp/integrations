<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run.
 *
 * Executes the official Apify API operation act_runs_last_get.
 */
class ApifyActRunsLastGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_get';
}
