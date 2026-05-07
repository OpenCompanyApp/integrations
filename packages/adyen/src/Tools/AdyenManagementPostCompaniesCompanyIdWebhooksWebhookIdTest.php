<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Test a webhook.
 *
 * Executes the official Adyen management API operation post-companies-companyId-webhooks-webhookId-test.
 */
class AdyenManagementPostCompaniesCompanyIdWebhooksWebhookIdTest extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_webhooks_webhook_id_test';
}
