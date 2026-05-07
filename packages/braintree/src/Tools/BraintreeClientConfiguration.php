<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Client Configuration.
 *
 * Executes the official Braintree GraphQL field clientConfiguration.
 */
class BraintreeClientConfiguration extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_client_configuration';
}
