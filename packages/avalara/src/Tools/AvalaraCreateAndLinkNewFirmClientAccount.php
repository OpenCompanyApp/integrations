<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Request a new FirmClient account and create an approved linkage to it.
 *
 * Executes the official Avalara AvaTax REST API operation CreateAndLinkNewFirmClientAccount.
 */
class AvalaraCreateAndLinkNewFirmClientAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_and_link_new_firm_client_account';
}