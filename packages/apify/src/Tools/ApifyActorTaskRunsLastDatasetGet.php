<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last task run's default dataset.
 *
 * Executes the official Apify API operation actorTask_runs_last_dataset_get.
 */
class ApifyActorTaskRunsLastDatasetGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_dataset_get';
}
