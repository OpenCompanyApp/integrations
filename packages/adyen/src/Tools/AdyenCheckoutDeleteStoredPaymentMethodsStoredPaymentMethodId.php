<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Delete a token for stored payment details.
 *
 * Executes the official Adyen checkout API operation delete-storedPaymentMethods-storedPaymentMethodId.
 */
class AdyenCheckoutDeleteStoredPaymentMethodsStoredPaymentMethodId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_delete_stored_payment_methods_stored_payment_method_id';
}
