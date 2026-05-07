<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Test a webhook.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-webhooks-webhookId-test.
 */
class AdyenManagementPostMerchantsMerchantIdWebhooksWebhookIdTest extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_webhooks_webhook_id_test';
}
