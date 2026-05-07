<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last task run's default store's list of keys.
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_keys_get.
 */
class ApifyActorTaskRunsLastKeyValueStoreKeysGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_keys_get';
}
