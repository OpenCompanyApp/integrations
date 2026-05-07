<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update an authorised amount.
 *
 * Executes the official Adyen checkout API operation post-payments-paymentPspReference-amountUpdates.
 */
class AdyenCheckoutPostPaymentsPaymentPspReferenceAmountUpdates extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments_payment_psp_reference_amount_updates';
}
