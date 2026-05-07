<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Run task synchronously.
 *
 * Executes the official Apify API operation actorTask_runSync_post.
 */
class ApifyActorTaskRunSyncPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_run_sync_post';
}
