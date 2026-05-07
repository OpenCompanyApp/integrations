<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run.
 *
 * Executes the official Apify API operation actorTask_runs_last_get.
 */
class ApifyActorTaskRunsLastGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_get';
}
