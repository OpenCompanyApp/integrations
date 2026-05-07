<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List jurisdictions hierarchy based on the filter provided.
 *
 * Executes the official Avalara AvaTax REST API operation ListJurisdictionsHierarchy.
 */
class AvalaraListJurisdictionsHierarchy extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_jurisdictions_hierarchy';
}