<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported nexus for a country..
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusByCountry.
 */
class AvalaraListNexusByCountry extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_by_country';
}