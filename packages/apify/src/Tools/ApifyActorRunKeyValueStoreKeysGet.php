<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default store's list of keys.
 *
 * Executes the official Apify API operation actorRun_keyValueStore_keys_get.
 */
class ApifyActorRunKeyValueStoreKeysGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_key_value_store_keys_get';
}
