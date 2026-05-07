<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve UPCs for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListUPCsByCompany.
 */
class AvalaraListUPCsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_up_cs_by_company';
}