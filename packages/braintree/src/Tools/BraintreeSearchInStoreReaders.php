<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search In Store Readers.
 *
 * Executes the official Braintree GraphQL field inStoreReaders.
 */
class BraintreeSearchInStoreReaders extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_in_store_readers';
}
