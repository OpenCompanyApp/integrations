<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update last run's default dataset.
 *
 * Executes the official Apify API operation act_runs_last_dataset_put.
 */
class ApifyActRunsLastDatasetPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_dataset_put';
}
