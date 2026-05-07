<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Samsung Pay Card.
 *
 * Executes the official Braintree GraphQL field tokenizeSamsungPayCard.
 */
class BraintreeTokenizeSamsungPayCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_samsung_pay_card';
}
