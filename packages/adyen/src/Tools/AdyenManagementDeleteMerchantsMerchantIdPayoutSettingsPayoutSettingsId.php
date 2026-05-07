<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Delete a payout setting.
 *
 * Executes the official Adyen management API operation delete-merchants-merchantId-payoutSettings-payoutSettingsId.
 */
class AdyenManagementDeleteMerchantsMerchantIdPayoutSettingsPayoutSettingsId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_merchants_merchant_id_payout_settings_payout_settings_id';
}
