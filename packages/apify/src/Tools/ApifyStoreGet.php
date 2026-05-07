<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of Actors in Store.
 *
 * Executes the official Apify API operation store_get.
 */
class ApifyStoreGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_store_get';
}
