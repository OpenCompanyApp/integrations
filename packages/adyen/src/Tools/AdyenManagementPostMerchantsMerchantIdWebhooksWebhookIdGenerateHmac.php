<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate an HMAC key.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-webhooks-webhookId-generateHmac.
 */
class AdyenManagementPostMerchantsMerchantIdWebhooksWebhookIdGenerateHmac extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_webhooks_webhook_id_generate_hmac';
}
