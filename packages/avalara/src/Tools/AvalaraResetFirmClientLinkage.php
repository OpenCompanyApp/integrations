<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Reset linkage status between a client and firm back to requested.
 *
 * Executes the official Avalara AvaTax REST API operation ResetFirmClientLinkage.
 */
class AvalaraResetFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_reset_firm_client_linkage';
}