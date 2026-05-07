<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Item Display From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestItemDisplayFromInStoreReader.
 */
class BraintreeRequestItemDisplayFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_item_display_from_in_store_reader';
}
