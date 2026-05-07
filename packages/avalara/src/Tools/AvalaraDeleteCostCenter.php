<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete cost center for the given id.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCostCenter.
 */
class AvalaraDeleteCostCenter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_cost_center';
}