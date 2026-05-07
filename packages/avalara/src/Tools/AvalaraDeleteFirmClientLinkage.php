<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a linkage.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteFirmClientLinkage.
 */
class AvalaraDeleteFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_firm_client_linkage';
}