<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of rate types by country, TaxType and by TaxSubType.
 *
 * Executes the official Avalara AvaTax REST API operation ListRateTypesByCountryTaxTypeTaxSubType.
 */
class AvalaraListRateTypesByCountryTaxTypeTaxSubType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_rate_types_by_country_tax_type_tax_sub_type';
}