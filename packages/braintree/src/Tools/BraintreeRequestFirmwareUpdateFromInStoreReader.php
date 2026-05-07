<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Request Firmware Update From In Store Reader.
 *
 * Executes the official Braintree GraphQL field requestFirmwareUpdateFromInStoreReader.
 */
class BraintreeRequestFirmwareUpdateFromInStoreReader extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_request_firmware_update_from_in_store_reader';
}
