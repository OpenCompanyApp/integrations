<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Pay Pal One Time Payment.
 *
 * Executes the official Braintree GraphQL field updatePayPalOneTimePayment.
 */
class BraintreeUpdatePayPalOneTimePayment extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_pay_pal_one_time_payment';
}
