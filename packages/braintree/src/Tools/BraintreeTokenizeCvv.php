<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Cvv.
 *
 * Executes the official Braintree GraphQL field tokenizeCvv.
 */
class BraintreeTokenizeCvv extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_cvv';
}
