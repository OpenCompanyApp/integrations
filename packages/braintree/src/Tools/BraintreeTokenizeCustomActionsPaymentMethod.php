<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Custom Actions Payment Method.
 *
 * Executes the official Braintree GraphQL field tokenizeCustomActionsPaymentMethod.
 */
class BraintreeTokenizeCustomActionsPaymentMethod extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_custom_actions_payment_method';
}
