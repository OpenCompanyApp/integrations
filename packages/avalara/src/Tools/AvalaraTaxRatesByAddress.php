<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Sales tax rates for a specified address.
 *
 * Executes the official Avalara AvaTax REST API operation TaxRatesByAddress.
 */
class AvalaraTaxRatesByAddress extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_tax_rates_by_address';
}