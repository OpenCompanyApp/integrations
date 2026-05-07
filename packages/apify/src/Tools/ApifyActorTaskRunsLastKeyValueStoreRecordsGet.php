<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Download last task run's default store's records.
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_records_get.
 */
class ApifyActorTaskRunsLastKeyValueStoreRecordsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_records_get';
}
