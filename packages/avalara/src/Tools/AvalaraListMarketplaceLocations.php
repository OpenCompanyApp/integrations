<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of locations for a marketplace..
 *
 * Executes the official Avalara AvaTax REST API operation ListMarketplaceLocations.
 */
class AvalaraListMarketplaceLocations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_marketplace_locations';
}