<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Store items in last task run's dataset.
 *
 * Executes the official Apify API operation actorTask_runs_last_dataset_items_post.
 */
class ApifyActorTaskRunsLastDatasetItemsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_dataset_items_post';
}
