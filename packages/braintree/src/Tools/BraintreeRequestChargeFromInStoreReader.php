<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Charge From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestChargeFromInStoreReader.
 */
class BraintreeRequestChargeFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_charge_from_in_store_reader';
}
