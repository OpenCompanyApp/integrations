<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a store.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-stores-storeId.
 */
class AdyenManagementPatchMerchantsMerchantIdStoresStoreId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_stores_store_id';
}
