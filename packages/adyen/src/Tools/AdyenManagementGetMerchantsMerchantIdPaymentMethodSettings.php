<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get all payment methods.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-paymentMethodSettings.
 */
class AdyenManagementGetMerchantsMerchantIdPaymentMethodSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_payment_method_settings';
}
