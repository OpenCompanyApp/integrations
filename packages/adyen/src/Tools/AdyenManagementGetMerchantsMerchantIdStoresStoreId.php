<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a store.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-stores-storeId.
 */
class AdyenManagementGetMerchantsMerchantIdStoresStoreId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_stores_store_id';
}
