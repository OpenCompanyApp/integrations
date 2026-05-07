<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of key-value stores.
 *
 * Executes the official Apify API operation keyValueStores_get.
 */
class ApifyKeyValueStoresGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_stores_get';
}
