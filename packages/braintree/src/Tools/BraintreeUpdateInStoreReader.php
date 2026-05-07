<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update In Store Reader.
 *
 * Executes the official Braintree GraphQL field updateInStoreReader.
 */
class BraintreeUpdateInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_in_store_reader';
}
