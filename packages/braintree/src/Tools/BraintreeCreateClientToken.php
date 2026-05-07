<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Client Token.
 *
 * Executes the official Braintree GraphQL field createClientToken.
 */
class BraintreeCreateClientToken extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_client_token';
}
