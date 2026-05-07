<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Start a transaction.
 *
 * Executes the official Adyen checkout API operation post-payments.
 */
class AdyenCheckoutPostPayments extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payments';
}
