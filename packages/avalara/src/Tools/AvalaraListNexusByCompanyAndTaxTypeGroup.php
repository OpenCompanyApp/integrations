<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve nexus for this company By TaxTypeGroup.
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusByCompanyAndTaxTypeGroup.
 */
class AvalaraListNexusByCompanyAndTaxTypeGroup extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_by_company_and_tax_type_group';
}