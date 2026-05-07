<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Store items in last run's dataset.
 *
 * Executes the official Apify API operation act_runs_last_dataset_items_post.
 */
class ApifyActRunsLastDatasetItemsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_dataset_items_post';
}
