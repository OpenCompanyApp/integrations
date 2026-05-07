<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last Actor task run's log.
 *
 * Executes the official Apify API operation actorTask_last_log_get.
 */
class ApifyActorTaskLastLogGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_last_log_get';
}
