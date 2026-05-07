<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an API credential.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-apiCredentials.
 */
class AdyenManagementPostMerchantsMerchantIdApiCredentials extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_api_credentials';
}
