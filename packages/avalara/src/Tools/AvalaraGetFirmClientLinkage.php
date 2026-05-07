<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get linkage between a firm and client by id.
 *
 * Executes the official Avalara AvaTax REST API operation GetFirmClientLinkage.
 */
class AvalaraGetFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_firm_client_linkage';
}