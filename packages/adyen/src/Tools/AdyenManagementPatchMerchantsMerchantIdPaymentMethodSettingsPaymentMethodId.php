<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update a payment method.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-paymentMethodSettings-paymentMethodId.
 */
class AdyenManagementPatchMerchantsMerchantIdPaymentMethodSettingsPaymentMethodId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_payment_method_settings_payment_method_id';
}
