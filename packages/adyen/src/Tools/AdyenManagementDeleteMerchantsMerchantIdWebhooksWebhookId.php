<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Remove a webhook.
 *
 * Executes the official Adyen management API operation delete-merchants-merchantId-webhooks-webhookId.
 */
class AdyenManagementDeleteMerchantsMerchantIdWebhooksWebhookId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_merchants_merchant_id_webhooks_webhook_id';
}
