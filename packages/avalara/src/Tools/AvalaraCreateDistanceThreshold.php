<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create one or more DistanceThreshold objects.
 *
 * Executes the official Avalara AvaTax REST API operation CreateDistanceThreshold.
 */
class AvalaraCreateDistanceThreshold extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_distance_threshold';
}