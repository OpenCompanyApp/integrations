<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve tax codes for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxCodesByCompany.
 */
class AvalaraListTaxCodesByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_codes_by_company';
}