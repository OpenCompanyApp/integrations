<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get Apple Pay domains.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-paymentMethodSettings-paymentMethodId-getApplePayDomains.
 */
class AdyenManagementGetMerchantsMerchantIdPaymentMethodSettingsPaymentMethodIdGetApplePayDomains extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_payment_method_settings_payment_method_id_get_apple_pay_domains';
}
