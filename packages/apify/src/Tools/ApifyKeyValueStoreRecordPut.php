<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Store record.
 *
 * Executes the official Apify API operation keyValueStore_record_put.
 */
class ApifyKeyValueStoreRecordPut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_store_record_put';
}
