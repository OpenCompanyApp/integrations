<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Capture an authorised payment.
 *
 * Executes the official Adyen checkout API operation post-payments-paymentPspReference-captures.
 */
class AdyenCheckoutPostPaymentsPaymentPspReferenceCaptures extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments_payment_psp_reference_captures';
}
