<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of applicable TaxTypes.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxTypesByNexusAndCountry.
 */
class AvalaraListTaxTypesByNexusAndCountry extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_types_by_nexus_and_country';
}