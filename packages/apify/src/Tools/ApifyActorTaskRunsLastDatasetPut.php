<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update last task run's default dataset.
 *
 * Executes the official Apify API operation actorTask_runs_last_dataset_put.
 */
class ApifyActorTaskRunsLastDatasetPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_dataset_put';
}
