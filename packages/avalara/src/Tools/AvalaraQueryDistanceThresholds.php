<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all DistanceThreshold objects.
 *
 * Executes the official Avalara AvaTax REST API operation QueryDistanceThresholds.
 */
class AvalaraQueryDistanceThresholds extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_distance_thresholds';
}