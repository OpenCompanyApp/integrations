<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a store.
 *
 * Executes the official Adyen management API operation patch-stores-storeId.
 */
class AdyenManagementPatchStoresStoreId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_stores_store_id';
}
