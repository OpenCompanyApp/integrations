<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last task run's dataset statistics.
 *
 * Executes the official Apify API operation actorTask_runs_last_dataset_statistics_get.
 */
class ApifyActorTaskRunsLastDatasetStatisticsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_dataset_statistics_get';
}
