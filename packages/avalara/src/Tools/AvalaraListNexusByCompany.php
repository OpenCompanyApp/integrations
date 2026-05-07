<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve nexus for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusByCompany.
 */
class AvalaraListNexusByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_by_company';
}