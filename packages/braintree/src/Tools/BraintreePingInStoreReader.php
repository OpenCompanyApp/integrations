<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Ping In Store Reader.
 *
 * Executes the official Braintree GraphQL field pingInStoreReader.
 */
class BraintreePingInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_ping_in_store_reader';
}
