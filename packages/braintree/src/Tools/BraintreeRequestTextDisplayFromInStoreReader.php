<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Text Display From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestTextDisplayFromInStoreReader.
 */
class BraintreeRequestTextDisplayFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_text_display_from_in_store_reader';
}
