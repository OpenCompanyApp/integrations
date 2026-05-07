<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported nexus for a tax type group..
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusByTaxTypeGroup.
 */
class AvalaraListNexusByTaxTypeGroup extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_by_tax_type_group';
}