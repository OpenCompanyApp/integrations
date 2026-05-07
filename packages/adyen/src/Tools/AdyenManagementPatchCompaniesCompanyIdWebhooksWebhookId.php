<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a webhook.
 *
 * Executes the official Adyen management API operation patch-companies-companyId-webhooks-webhookId.
 */
class AdyenManagementPatchCompaniesCompanyIdWebhooksWebhookId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_webhooks_webhook_id';
}
