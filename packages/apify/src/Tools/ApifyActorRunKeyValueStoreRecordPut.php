<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Store record in default store.
 *
 * Executes the official Apify API operation actorRun_keyValueStore_record_put.
 */
class ApifyActorRunKeyValueStoreRecordPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_key_value_store_record_put';
}
