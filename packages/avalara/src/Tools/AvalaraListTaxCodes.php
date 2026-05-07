<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax codes..
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxCodes.
 */
class AvalaraListTaxCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_codes';
}