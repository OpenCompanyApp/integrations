<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default store.
 *
 * Executes the official Apify API operation actorRun_keyValueStore_get.
 */
class ApifyActorRunKeyValueStoreGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_key_value_store_get';
}
