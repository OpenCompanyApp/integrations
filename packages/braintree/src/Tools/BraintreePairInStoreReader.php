<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Pair In Store Reader.
 *
 * Executes the official Braintree GraphQL field pairInStoreReader.
 */
class BraintreePairInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_pair_in_store_reader';
}
