<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Authorize Payment Method.
 *
 * Executes the official Braintree GraphQL field authorizePaymentMethod.
 */
class BraintreeAuthorizePaymentMethod extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_authorize_payment_method';
}
