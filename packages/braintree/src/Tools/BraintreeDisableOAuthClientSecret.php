<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Disable Oauth Client Secret.
 *
 * Executes the official Braintree GraphQL field disableOAuthClientSecret.
 */
class BraintreeDisableOAuthClientSecret extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_disable_oauth_client_secret';
}
