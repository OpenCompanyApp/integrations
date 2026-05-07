<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Amount Prompt From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestAmountPromptFromInStoreReader.
 */
class BraintreeRequestAmountPromptFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_amount_prompt_from_in_store_reader';
}
