<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Delete Payment Method From Single Use Token.
 *
 * Executes the official Braintree GraphQL field deletePaymentMethodFromSingleUseToken.
 */
class BraintreeDeletePaymentMethodFromSingleUseToken extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_delete_payment_method_from_single_use_token';
}
