<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Run task synchronously and get dataset items.
 *
 * Executes the official Apify API operation actorTask_runSyncGetDatasetItems_get.
 */
class ApifyActorTaskRunSyncGetDatasetItemsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_run_sync_get_dataset_items_get';
}
