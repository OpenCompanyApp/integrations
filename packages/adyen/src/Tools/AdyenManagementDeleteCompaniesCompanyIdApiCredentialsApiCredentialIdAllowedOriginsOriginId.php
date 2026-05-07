<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Delete an allowed origin.
 *
 * Executes the official Adyen management API operation delete-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins-originId.
 */
class AdyenManagementDeleteCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOriginsOriginId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_companies_company_id_api_credentials_api_credential_id_allowed_origins_origin_id';
}
