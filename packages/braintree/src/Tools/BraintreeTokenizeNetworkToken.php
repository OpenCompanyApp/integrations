<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Network Token.
 *
 * Executes the official Braintree GraphQL field tokenizeNetworkToken.
 */
class BraintreeTokenizeNetworkToken extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_network_token';
}
