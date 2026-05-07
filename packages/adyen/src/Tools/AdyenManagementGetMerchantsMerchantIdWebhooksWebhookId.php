<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a webhook.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-webhooks-webhookId.
 */
class AdyenManagementGetMerchantsMerchantIdWebhooksWebhookId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_webhooks_webhook_id';
}
