<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an allowed origin.
 *
 * Executes the official Adyen management API operation post-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins.
 */
class AdyenManagementPostCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOrigins extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_api_credentials_api_credential_id_allowed_origins';
}
