<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate new API key.
 *
 * Executes the official Adyen management API operation post-companies-companyId-apiCredentials-apiCredentialId-generateApiKey.
 */
class AdyenManagementPostCompaniesCompanyIdApiCredentialsApiCredentialIdGenerateApiKey extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_api_credentials_api_credential_id_generate_api_key';
}
