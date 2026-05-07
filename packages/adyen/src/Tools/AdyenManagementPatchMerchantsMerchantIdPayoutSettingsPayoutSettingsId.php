<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a payout setting.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-payoutSettings-payoutSettingsId.
 */
class AdyenManagementPatchMerchantsMerchantIdPayoutSettingsPayoutSettingsId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_payout_settings_payout_settings_id';
}
