<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a new user.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-users.
 */
class AdyenManagementPostMerchantsMerchantIdUsers extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_users';
}
