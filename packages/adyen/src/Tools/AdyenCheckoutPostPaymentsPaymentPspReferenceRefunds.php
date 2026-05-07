<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Refund a captured payment.
 *
 * Executes the official Adyen checkout API operation post-payments-paymentPspReference-refunds.
 */
class AdyenCheckoutPostPaymentsPaymentPspReferenceRefunds extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments_payment_psp_reference_refunds';
}
