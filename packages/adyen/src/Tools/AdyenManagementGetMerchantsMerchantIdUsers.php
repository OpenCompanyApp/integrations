<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of users.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-users.
 */
class AdyenManagementGetMerchantsMerchantIdUsers extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_users';
}
