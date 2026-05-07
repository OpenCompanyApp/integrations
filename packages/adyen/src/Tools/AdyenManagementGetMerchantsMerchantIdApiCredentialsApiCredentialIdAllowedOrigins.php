<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of allowed origins.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins.
 */
class AdyenManagementGetMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOrigins extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins';
}
