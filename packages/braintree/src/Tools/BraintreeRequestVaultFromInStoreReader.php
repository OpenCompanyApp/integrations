<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Vault From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestVaultFromInStoreReader.
 */
class BraintreeRequestVaultFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_vault_from_in_store_reader';
}
