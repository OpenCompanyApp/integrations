<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of the Tax Forms available.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxForms.
 */
class AvalaraListTaxForms extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_forms';
}