<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Apple Pay Card.
 *
 * Executes the official Braintree GraphQL field tokenizeApplePayCard.
 */
class BraintreeTokenizeApplePayCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_apple_pay_card';
}
