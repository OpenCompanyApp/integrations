<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's default store's list of keys.
 *
 * Executes the official Apify API operation act_runs_last_keyValueStore_keys_get.
 */
class ApifyActRunsLastKeyValueStoreKeysGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_key_value_store_keys_get';
}
