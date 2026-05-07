<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of tax type groups.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxTypeGroups.
 */
class AvalaraListTaxTypeGroups extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_type_groups';
}