<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a webhook.
 *
 * Executes the official Adyen management API operation get-companies-companyId-webhooks-webhookId.
 */
class AdyenManagementGetCompaniesCompanyIdWebhooksWebhookId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_webhooks_webhook_id';
}
