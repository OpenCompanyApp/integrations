<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's dataset items.
 *
 * Executes the official Apify API operation act_runs_last_dataset_items_get.
 */
class ApifyActRunsLastDatasetItemsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_dataset_items_get';
}
