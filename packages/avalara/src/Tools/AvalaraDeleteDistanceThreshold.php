<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single DistanceThreshold object.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteDistanceThreshold.
 */
class AvalaraDeleteDistanceThreshold extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_distance_threshold';
}