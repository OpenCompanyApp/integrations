<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Create key-value store.
 *
 * Executes the official Apify API operation keyValueStores_post.
 */
class ApifyKeyValueStoresPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_key_value_stores_post';
}
