<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Cancel an authorised payment.
 *
 * Executes the official Adyen checkout API operation post-payments-paymentPspReference-cancels.
 */
class AdyenCheckoutPostPaymentsPaymentPspReferenceCancels extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments_payment_psp_reference_cancels';
}
