<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Set up a webhook.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-webhooks.
 */
class AdyenManagementPostMerchantsMerchantIdWebhooks extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_webhooks';
}
