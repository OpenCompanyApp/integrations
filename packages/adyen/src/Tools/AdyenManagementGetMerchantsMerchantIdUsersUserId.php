<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get user details.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-users-userId.
 */
class AdyenManagementGetMerchantsMerchantIdUsersUserId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_users_user_id';
}
