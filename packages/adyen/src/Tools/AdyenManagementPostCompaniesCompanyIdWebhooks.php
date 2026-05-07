<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Set up a webhook.
 *
 * Executes the official Adyen management API operation post-companies-companyId-webhooks.
 */
class AdyenManagementPostCompaniesCompanyIdWebhooks extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_webhooks';
}
