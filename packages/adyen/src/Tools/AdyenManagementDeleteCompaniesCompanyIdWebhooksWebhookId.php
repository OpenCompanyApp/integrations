<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Remove a webhook.
 *
 * Executes the official Adyen management API operation delete-companies-companyId-webhooks-webhookId.
 */
class AdyenManagementDeleteCompaniesCompanyIdWebhooksWebhookId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_companies_company_id_webhooks_webhook_id';
}
