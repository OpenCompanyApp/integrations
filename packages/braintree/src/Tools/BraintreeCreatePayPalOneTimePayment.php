<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Pay Pal One Time Payment.
 *
 * Executes the official Braintree GraphQL field createPayPalOneTimePayment.
 */
class BraintreeCreatePayPalOneTimePayment extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_pay_pal_one_time_payment';
}
