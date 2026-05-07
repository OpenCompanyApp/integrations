<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete default store's record.
 *
 * Executes the official Apify API operation actorRun_keyValueStore_record_delete.
 */
class ApifyActorRunKeyValueStoreRecordDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_key_value_store_record_delete';
}
