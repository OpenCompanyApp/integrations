<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update last task run's default store.
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_put.
 */
class ApifyActorTaskRunsLastKeyValueStorePut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_put';
}
