<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Refund From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestRefundFromInStoreReader.
 */
class BraintreeRequestRefundFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_refund_from_in_store_reader';
}
