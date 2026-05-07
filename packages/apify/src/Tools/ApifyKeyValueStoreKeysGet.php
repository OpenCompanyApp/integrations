<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of keys.
 *
 * Executes the official Apify API operation keyValueStore_keys_get.
 */
class ApifyKeyValueStoreKeysGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_store_keys_get';
}
