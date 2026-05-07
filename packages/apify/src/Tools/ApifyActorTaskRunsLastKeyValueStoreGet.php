<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last task run's default store.
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_get.
 */
class ApifyActorTaskRunsLastKeyValueStoreGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_get';
}
