<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last task run's dataset items.
 *
 * Executes the official Apify API operation actorTask_runs_last_dataset_items_get.
 */
class ApifyActorTaskRunsLastDatasetItemsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_dataset_items_get';
}
