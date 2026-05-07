<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Universal Access Token.
 *
 * Executes the official Braintree GraphQL field createUniversalAccessToken.
 */
class BraintreeCreateUniversalAccessToken extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_universal_access_token';
}
