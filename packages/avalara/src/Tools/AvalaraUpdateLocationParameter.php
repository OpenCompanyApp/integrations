<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a location parameter.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateLocationParameter.
 */
class AvalaraUpdateLocationParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_location_parameter';
}