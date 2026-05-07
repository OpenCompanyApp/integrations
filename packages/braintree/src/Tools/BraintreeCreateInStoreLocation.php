<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create In Store Location.
 *
 * Executes the official Braintree GraphQL field createInStoreLocation.
 */
class BraintreeCreateInStoreLocation extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_in_store_location';
}
