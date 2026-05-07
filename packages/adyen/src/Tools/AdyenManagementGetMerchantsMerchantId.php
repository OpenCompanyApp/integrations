<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a merchant account.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId.
 */
class AdyenManagementGetMerchantsMerchantId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id';
}
