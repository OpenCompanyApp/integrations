<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create new Country Coefficients. If already exist update them..
 *
 * Executes the official Avalara AvaTax REST API operation CreateCountryCoefficients.
 */
class AvalaraCreateCountryCoefficients extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_country_coefficients';
}