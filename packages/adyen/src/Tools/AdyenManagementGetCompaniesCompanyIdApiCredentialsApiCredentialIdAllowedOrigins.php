<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of allowed origins.
 *
 * Executes the official Adyen management API operation get-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins.
 */
class AdyenManagementGetCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOrigins extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_api_credentials_api_credential_id_allowed_origins';
}
