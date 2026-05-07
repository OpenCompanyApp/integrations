<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all cost centers.
 *
 * Executes the official Avalara AvaTax REST API operation QueryCostCenters.
 */
class AvalaraQueryCostCenters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_cost_centers';
}