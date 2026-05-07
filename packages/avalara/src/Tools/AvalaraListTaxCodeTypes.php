<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax code types..
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxCodeTypes.
 */
class AvalaraListTaxCodeTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_code_types';
}