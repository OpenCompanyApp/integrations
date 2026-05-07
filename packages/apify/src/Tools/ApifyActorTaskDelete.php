<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete task.
 *
 * Executes the official Apify API operation actorTask_delete.
 */
class ApifyActorTaskDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_delete';
}
