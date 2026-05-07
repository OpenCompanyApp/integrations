<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve cost centers for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListCostCentersByCompany.
 */
class AvalaraListCostCentersByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_cost_centers_by_company';
}