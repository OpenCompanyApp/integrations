<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an API credential..
 *
 * Executes the official Adyen management API operation post-companies-companyId-apiCredentials.
 */
class AdyenManagementPostCompaniesCompanyIdApiCredentials extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_api_credentials';
}
