<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Print From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestPrintFromInStoreReader.
 */
class BraintreeRequestPrintFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_print_from_in_store_reader';
}
