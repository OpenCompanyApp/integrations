<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Verify Payment Method.
 *
 * Executes the official Braintree GraphQL field verifyPaymentMethod.
 */
class BraintreeVerifyPaymentMethod extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_verify_payment_method';
}
