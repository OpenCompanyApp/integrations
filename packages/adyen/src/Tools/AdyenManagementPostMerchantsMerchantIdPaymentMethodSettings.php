<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Request a payment method.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-paymentMethodSettings.
 */
class AdyenManagementPostMerchantsMerchantIdPaymentMethodSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_payment_method_settings';
}
