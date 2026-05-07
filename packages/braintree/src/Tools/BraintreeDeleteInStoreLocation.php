<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Delete In Store Location.
 *
 * Executes the official Braintree GraphQL field deleteInStoreLocation.
 */
class BraintreeDeleteInStoreLocation extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_delete_in_store_location';
}
