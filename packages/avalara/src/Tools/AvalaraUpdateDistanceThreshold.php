<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a DistanceThreshold object.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateDistanceThreshold.
 */
class AvalaraUpdateDistanceThreshold extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_distance_threshold';
}