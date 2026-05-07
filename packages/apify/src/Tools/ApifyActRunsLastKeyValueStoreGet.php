<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get last run's default store.
 *
 * Executes the official Apify API operation act_runs_last_keyValueStore_get.
 */
class ApifyActRunsLastKeyValueStoreGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_key_value_store_get';
}
