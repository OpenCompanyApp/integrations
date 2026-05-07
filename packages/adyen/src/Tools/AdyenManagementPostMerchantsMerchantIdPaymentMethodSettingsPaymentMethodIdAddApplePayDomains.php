<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Add an Apple Pay domain.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-paymentMethodSettings-paymentMethodId-addApplePayDomains.
 */
class AdyenManagementPostMerchantsMerchantIdPaymentMethodSettingsPaymentMethodIdAddApplePayDomains extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_payment_method_settings_payment_method_id_add_apple_pay_domains';
}
