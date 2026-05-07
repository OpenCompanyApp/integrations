<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete last run's default dataset.
 *
 * Executes the official Apify API operation act_runs_last_dataset_delete.
 */
class ApifyActRunsLastDatasetDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_dataset_delete';
}
