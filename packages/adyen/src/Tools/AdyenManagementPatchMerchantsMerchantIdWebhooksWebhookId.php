<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a webhook.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-webhooks-webhookId.
 */
class AdyenManagementPatchMerchantsMerchantIdWebhooksWebhookId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_webhooks_webhook_id';
}
