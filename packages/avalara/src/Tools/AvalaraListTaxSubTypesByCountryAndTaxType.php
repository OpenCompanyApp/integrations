<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of tax sub types by Country and TaxType.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxSubTypesByCountryAndTaxType.
 */
class AvalaraListTaxSubTypesByCountryAndTaxType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_sub_types_by_country_and_tax_type';
}