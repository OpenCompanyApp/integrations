<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of users.
 *
 * Executes the official Adyen management API operation get-companies-companyId-users.
 */
class AdyenManagementGetCompaniesCompanyIdUsers extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_users';
}
