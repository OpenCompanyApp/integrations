<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get VAT rates for a country.
 *
 * Executes the official Avalara AvaTax REST API operation GetVATRatesByCountry.
 */
class AvalaraGetVATRatesByCountry extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_vat_rates_by_country';
}