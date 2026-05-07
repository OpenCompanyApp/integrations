<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of tasks.
 *
 * Executes the official Apify API operation actorTasks_get.
 */
class ApifyActorTasksGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_tasks_get';
}
