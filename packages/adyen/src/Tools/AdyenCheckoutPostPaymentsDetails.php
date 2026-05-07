<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Submit details for a payment.
 *
 * Executes the official Adyen checkout API operation post-payments-details.
 */
class AdyenCheckoutPostPaymentsDetails extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments_details';
}
