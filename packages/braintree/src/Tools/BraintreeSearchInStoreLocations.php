<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search In Store Locations.
 *
 * Executes the official Braintree GraphQL field inStoreLocations.
 */
class BraintreeSearchInStoreLocations extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_in_store_locations';
}
