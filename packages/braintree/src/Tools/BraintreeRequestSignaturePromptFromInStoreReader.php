<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Signature Prompt From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestSignaturePromptFromInStoreReader.
 */
class BraintreeRequestSignaturePromptFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_signature_prompt_from_in_store_reader';
}
