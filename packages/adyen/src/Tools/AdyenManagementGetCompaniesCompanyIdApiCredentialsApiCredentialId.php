<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get an API credential.
 *
 * Executes the official Adyen management API operation get-companies-companyId-apiCredentials-apiCredentialId.
 */
class AdyenManagementGetCompaniesCompanyIdApiCredentialsApiCredentialId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_api_credentials_api_credential_id';
}
