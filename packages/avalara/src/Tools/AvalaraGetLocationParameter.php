<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single company location parameter.
 *
 * Executes the official Avalara AvaTax REST API operation GetLocationParameter.
 */
class AvalaraGetLocationParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_location_parameter';
}