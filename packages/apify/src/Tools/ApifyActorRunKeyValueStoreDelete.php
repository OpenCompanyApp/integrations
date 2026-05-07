<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete default store.
 *
 * Executes the official Apify API operation actorRun_keyValueStore_delete.
 */
class ApifyActorRunKeyValueStoreDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_key_value_store_delete';
}
