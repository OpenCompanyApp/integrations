<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's dataset statistics.
 *
 * Executes the official Apify API operation act_runs_last_dataset_statistics_get.
 */
class ApifyActRunsLastDatasetStatisticsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_dataset_statistics_get';
}
