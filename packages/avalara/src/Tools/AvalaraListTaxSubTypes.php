<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of tax sub types.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxSubTypes.
 */
class AvalaraListTaxSubTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_sub_types';
}