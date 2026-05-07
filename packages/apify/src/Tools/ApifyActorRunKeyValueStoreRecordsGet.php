<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Download default store's records.
 *
 * Executes the official Apify API operation actorRun_keyValueStore_records_get.
 */
class ApifyActorRunKeyValueStoreRecordsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_key_value_store_records_get';
}
