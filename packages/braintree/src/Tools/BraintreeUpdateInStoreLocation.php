<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update In Store Location.
 *
 * Executes the official Braintree GraphQL field updateInStoreLocation.
 */
class BraintreeUpdateInStoreLocation extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_in_store_location';
}
