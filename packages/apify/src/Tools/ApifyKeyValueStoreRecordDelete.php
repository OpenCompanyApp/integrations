<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete record.
 *
 * Executes the official Apify API operation keyValueStore_record_delete.
 */
class ApifyKeyValueStoreRecordDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_store_record_delete';
}
