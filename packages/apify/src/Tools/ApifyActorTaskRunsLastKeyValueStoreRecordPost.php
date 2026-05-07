<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Store record in last task run's default store (POST).
 *
 * Executes the official Apify API operation actorTask_runs_last_keyValueStore_record_post.
 */
class ApifyActorTaskRunsLastKeyValueStoreRecordPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_runs_last_key_value_store_record_post';
}
