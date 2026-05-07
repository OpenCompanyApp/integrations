<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of nexus tax type groups.
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusTaxTypeGroups.
 */
class AvalaraListNexusTaxTypeGroups extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_tax_type_groups';
}