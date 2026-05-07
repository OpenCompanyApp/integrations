<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * List all webhooks.
 *
 * Executes the official Adyen management API operation get-companies-companyId-webhooks.
 */
class AdyenManagementGetCompaniesCompanyIdWebhooks extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_webhooks';
}
