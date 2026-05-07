<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single cost center.
 *
 * Executes the official Avalara AvaTax REST API operation GetCostCenterById.
 */
class AvalaraGetCostCenterById extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_cost_center_by_id';
}