<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all market place locations..
 *
 * Executes the official Avalara AvaTax REST API operation ListAllMarketplaceLocations.
 */
class AvalaraListAllMarketplaceLocations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_all_marketplace_locations';
}