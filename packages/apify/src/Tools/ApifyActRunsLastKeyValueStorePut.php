<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update last run's default store.
 *
 * Executes the official Apify API operation act_runs_last_keyValueStore_put.
 */
class ApifyActRunsLastKeyValueStorePut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_runs_last_key_value_store_put';
}
