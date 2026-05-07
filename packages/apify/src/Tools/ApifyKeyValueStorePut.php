<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Update store.
 *
 * Executes the official Apify API operation keyValueStore_put.
 */
class ApifyKeyValueStorePut extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_store_put';
}
