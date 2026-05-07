<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Magstripe Card.
 *
 * Executes the official Braintree GraphQL field tokenizeMagstripeCard.
 */
class BraintreeTokenizeMagstripeCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_magstripe_card';
}
