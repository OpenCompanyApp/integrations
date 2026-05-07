<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Confirmation Prompt From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestConfirmationPromptFromInStoreReader.
 */
class BraintreeRequestConfirmationPromptFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_confirmation_prompt_from_in_store_reader';
}
