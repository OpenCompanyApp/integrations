<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all ISO 3166 regions.
 *
 * Executes the official Avalara AvaTax REST API operation ListRegions.
 */
class AvalaraListRegions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_regions';
}