<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * List all webhooks.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-webhooks.
 */
class AdyenManagementGetMerchantsMerchantIdWebhooks extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_webhooks';
}
