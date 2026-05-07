<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a store.
 *
 * Executes the official Adyen management API operation get-stores-storeId.
 */
class AdyenManagementGetStoresStoreId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_stores_store_id';
}
