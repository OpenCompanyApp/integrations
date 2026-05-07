<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of task runs.
 *
 * Executes the official Apify API operation actorTask_runs_get.
 */
class ApifyActorTaskRunsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_get';
}
