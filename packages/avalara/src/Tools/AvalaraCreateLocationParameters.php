<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add parameters to a location..
 *
 * Executes the official Avalara AvaTax REST API operation CreateLocationParameters.
 */
class AvalaraCreateLocationParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_location_parameters';
}