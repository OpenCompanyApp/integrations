<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete last task run's default store's record.
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_record_delete.
 */
class ApifyActorTaskRunsLastKeyValueStoreRecordDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_record_delete';
}
