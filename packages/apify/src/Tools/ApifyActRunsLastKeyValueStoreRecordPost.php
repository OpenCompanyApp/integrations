<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Store record in last run's default store (POST).
 *
 * Executes the official Apify API operation act_runs_last_keyValueStore_record_post.
 */
class ApifyActRunsLastKeyValueStoreRecordPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_key_value_store_record_post';
}
