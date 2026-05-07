<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * In Store Locations.
 *
 * Executes the official Braintree GraphQL field inStoreLocations.
 */
class BraintreeInStoreLocations extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_in_store_locations';
}
