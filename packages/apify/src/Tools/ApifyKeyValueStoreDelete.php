<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete store.
 *
 * Executes the official Apify API operation keyValueStore_delete.
 */
class ApifyKeyValueStoreDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_store_delete';
}
