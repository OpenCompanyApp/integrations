<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Delete Oauth Client Secret.
 *
 * Executes the official Braintree GraphQL field deleteOAuthClientSecret.
 */
class BraintreeDeleteOAuthClientSecret extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_delete_oauth_client_secret';
}
