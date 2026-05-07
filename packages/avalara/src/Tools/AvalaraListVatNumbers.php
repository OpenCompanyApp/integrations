<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve VAT Numbers for a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListVatNumbers.
 */
class AvalaraListVatNumbers extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_vat_numbers';
}