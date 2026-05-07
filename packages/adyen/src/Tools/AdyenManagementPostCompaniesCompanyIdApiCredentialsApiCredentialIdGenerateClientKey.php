<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate new client key.
 *
 * Executes the official Adyen management API operation post-companies-companyId-apiCredentials-apiCredentialId-generateClientKey.
 */
class AdyenManagementPostCompaniesCompanyIdApiCredentialsApiCredentialIdGenerateClientKey extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_api_credentials_api_credential_id_generate_client_key';
}
