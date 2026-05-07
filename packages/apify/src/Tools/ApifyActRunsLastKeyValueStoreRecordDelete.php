<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete last run's default store's record.
 *
 * Executes the official Apify API operation act_runs_last_keyValueStore_record_delete.
 */
class ApifyActRunsLastKeyValueStoreRecordDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_key_value_store_record_delete';
}
