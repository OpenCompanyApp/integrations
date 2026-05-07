<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate new client key.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-apiCredentials-apiCredentialId-generateClientKey.
 */
class AdyenManagementPostMerchantsMerchantIdApiCredentialsApiCredentialIdGenerateClientKey extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_api_credentials_api_credential_id_generate_client_key';
}
