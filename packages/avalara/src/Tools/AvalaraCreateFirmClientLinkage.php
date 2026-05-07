<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Links a firm account with the client account.
 *
 * Executes the official Avalara AvaTax REST API operation CreateFirmClientLinkage.
 */
class AvalaraCreateFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_firm_client_linkage';
}