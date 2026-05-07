<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Non Pci Card Data From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestNonPciCardDataFromInStoreReader.
 */
class BraintreeRequestNonPciCardDataFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_non_pci_card_data_from_in_store_reader';
}
