<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a user.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-users-userId.
 */
class AdyenManagementPatchMerchantsMerchantIdUsersUserId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_users_user_id';
}
