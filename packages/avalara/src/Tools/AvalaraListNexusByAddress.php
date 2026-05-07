<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all nexus that apply to a specific address..
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusByAddress.
 */
class AvalaraListNexusByAddress extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_by_address';
}