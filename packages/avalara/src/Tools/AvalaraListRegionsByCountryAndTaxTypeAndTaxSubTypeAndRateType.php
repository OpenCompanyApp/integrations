<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of applicable regions by country tax type, tax sub type, and rate type for a given JurisdictionTypeId.
 *
 * Executes the official Avalara AvaTax REST API operation ListRegionsByCountryAndTaxTypeAndTaxSubTypeAndRateType.
 */
class AvalaraListRegionsByCountryAndTaxTypeAndTaxSubTypeAndRateType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_regions_by_country_and_tax_type_and_tax_sub_type_and_rate_type';
}