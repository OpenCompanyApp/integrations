<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve country coefficients for specific country.
 *
 * Executes the official Avalara AvaTax REST API operation ListCountryCoefficients.
 */
class AvalaraListCountryCoefficients extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_country_coefficients';
}