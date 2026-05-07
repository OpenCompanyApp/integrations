<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a payout setting.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-payoutSettings-payoutSettingsId.
 */
class AdyenManagementGetMerchantsMerchantIdPayoutSettingsPayoutSettingsId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_payout_settings_payout_settings_id';
}
