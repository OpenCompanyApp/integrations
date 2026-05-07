<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate an HMAC key.
 *
 * Executes the official Adyen management API operation post-companies-companyId-webhooks-webhookId-generateHmac.
 */
class AdyenManagementPostCompaniesCompanyIdWebhooksWebhookIdGenerateHmac extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_webhooks_webhook_id_generate_hmac';
}
