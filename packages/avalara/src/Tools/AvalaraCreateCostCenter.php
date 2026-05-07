<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create new cost center.
 *
 * Executes the official Avalara AvaTax REST API operation CreateCostCenter.
 */
class AvalaraCreateCostCenter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_cost_center';
}