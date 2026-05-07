<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of API credentials.
 *
 * Executes the official Adyen management API operation get-companies-companyId-apiCredentials.
 */
class AdyenManagementGetCompaniesCompanyIdApiCredentials extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_api_credentials';
}
