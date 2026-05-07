<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's default dataset.
 *
 * Executes the official Apify API operation act_runs_last_dataset_get.
 */
class ApifyActRunsLastDatasetGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_dataset_get';
}
