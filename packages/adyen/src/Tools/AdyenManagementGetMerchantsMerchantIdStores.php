<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of stores.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-stores.
 */
class AdyenManagementGetMerchantsMerchantIdStores extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_stores';
}
