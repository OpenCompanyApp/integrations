<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of rate types for each country.
 *
 * Executes the official Avalara AvaTax REST API operation ListRateTypesByCountry.
 */
class AvalaraListRateTypesByCountry extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_rate_types_by_country';
}