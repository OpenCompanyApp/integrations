<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Download last run's default store's records.
 *
 * Executes the official Apify API operation act_runs_last_keyValueStore_records_get.
 */
class ApifyActRunsLastKeyValueStoreRecordsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_key_value_store_records_get';
}
