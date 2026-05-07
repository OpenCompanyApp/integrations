<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Authorize From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestAuthorizeFromInStoreReader.
 */
class BraintreeRequestAuthorizeFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_authorize_from_in_store_reader';
}
