<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of runs.
 *
 * Executes the official Apify API operation act_runs_get.
 */
class ApifyActRunsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_get';
}
