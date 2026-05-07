<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Oauth Client Secret.
 *
 * Executes the official Braintree GraphQL field createOAuthClientSecret.
 */
class BraintreeCreateOAuthClientSecret extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_oauth_client_secret';
}
