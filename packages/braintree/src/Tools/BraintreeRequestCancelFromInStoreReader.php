<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Cancel From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestCancelFromInStoreReader.
 */
class BraintreeRequestCancelFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_cancel_from_in_store_reader';
}
