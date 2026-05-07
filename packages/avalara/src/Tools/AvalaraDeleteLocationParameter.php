<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single location parameter.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteLocationParameter.
 */
class AvalaraDeleteLocationParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_location_parameter';
}