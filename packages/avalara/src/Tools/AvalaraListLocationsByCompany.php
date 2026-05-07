<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve locations for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListLocationsByCompany.
 */
class AvalaraListLocationsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_locations_by_company';
}