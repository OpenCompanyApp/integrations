<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Pay Pal One Time Payment.
 *
 * Executes the official Braintree GraphQL field tokenizePayPalOneTimePayment.
 */
class BraintreeTokenizePayPalOneTimePayment extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_pay_pal_one_time_payment';
}
