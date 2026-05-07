<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a full FirmClientLinkage record.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateFirmClientLinkage.
 */
class AvalaraUpdateFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_firm_client_linkage';
}