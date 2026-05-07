<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Emv Card.
 *
 * Executes the official Braintree GraphQL field tokenizeEmvCard.
 */
class BraintreeTokenizeEmvCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_emv_card';
}
