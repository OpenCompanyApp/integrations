<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List client linkages for a firm or client.
 *
 * Executes the official Avalara AvaTax REST API operation ListFirmClientLinkage.
 */
class AvalaraListFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_firm_client_linkage';
}