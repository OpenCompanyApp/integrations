<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a company account.
 *
 * Executes the official Adyen management API operation get-companies-companyId.
 */
class AdyenManagementGetCompaniesCompanyId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id';
}
