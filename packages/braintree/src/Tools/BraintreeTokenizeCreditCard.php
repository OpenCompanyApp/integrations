<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Credit Card.
 *
 * Executes the official Braintree GraphQL field tokenizeCreditCard.
 */
class BraintreeTokenizeCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_credit_card';
}
