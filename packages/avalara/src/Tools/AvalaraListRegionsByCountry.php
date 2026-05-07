<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all ISO 3166 regions for a country.
 *
 * Executes the official Avalara AvaTax REST API operation ListRegionsByCountry.
 */
class AvalaraListRegionsByCountry extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_regions_by_country';
}