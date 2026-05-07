<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all DistanceThresholds for this company..
 *
 * Executes the official Avalara AvaTax REST API operation ListDistanceThresholds.
 */
class AvalaraListDistanceThresholds extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_distance_thresholds';
}