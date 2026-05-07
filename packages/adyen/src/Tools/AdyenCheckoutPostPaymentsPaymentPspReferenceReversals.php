<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Refund or cancel a payment.
 *
 * Executes the official Adyen checkout API operation post-payments-paymentPspReference-reversals.
 */
class AdyenCheckoutPostPaymentsPaymentPspReferenceReversals extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments_payment_psp_reference_reversals';
}
