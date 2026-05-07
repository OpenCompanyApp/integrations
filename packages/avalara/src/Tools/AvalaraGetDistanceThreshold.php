<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single DistanceThreshold.
 *
 * Executes the official Avalara AvaTax REST API operation GetDistanceThreshold.
 */
class AvalaraGetDistanceThreshold extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_distance_threshold';
}