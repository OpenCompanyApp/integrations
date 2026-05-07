<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Text Prompt From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestTextPromptFromInStoreReader.
 */
class BraintreeRequestTextPromptFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_text_prompt_from_in_store_reader';
}
