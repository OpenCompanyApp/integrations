<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Download records.
 *
 * Executes the official Apify API operation keyValueStore_records_get.
 */
class ApifyKeyValueStoreRecordsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_store_records_get';
}
