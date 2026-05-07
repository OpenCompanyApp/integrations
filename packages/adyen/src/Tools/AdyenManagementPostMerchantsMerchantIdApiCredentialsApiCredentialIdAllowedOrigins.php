<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an allowed origin.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins.
 */
class AdyenManagementPostMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOrigins extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins';
}
