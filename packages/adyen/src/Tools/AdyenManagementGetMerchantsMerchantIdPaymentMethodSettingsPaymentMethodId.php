<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get payment method details.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-paymentMethodSettings-paymentMethodId.
 */
class AdyenManagementGetMerchantsMerchantIdPaymentMethodSettingsPaymentMethodId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_payment_method_settings_payment_method_id';
}
