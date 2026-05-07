<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Sales tax rates for a specified country and postal code. This API is only available for US postal codes..
 *
 * Executes the official Avalara AvaTax REST API operation TaxRatesByPostalCode.
 */
class AvalaraTaxRatesByPostalCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_tax_rates_by_postal_code';
}