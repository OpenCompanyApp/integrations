<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List jurisdictions based on the filter provided.
 *
 * Executes the official Avalara AvaTax REST API operation ListJurisdictions.
 */
class AvalaraListJurisdictions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_jurisdictions';
}