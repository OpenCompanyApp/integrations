<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single cost center.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCostCenter.
 */
class AvalaraUpdateCostCenter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_cost_center';
}