<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last task run's default store's record.
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_record_get.
 */
class ApifyActorTaskRunsLastKeyValueStoreRecordGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_record_get';
}
