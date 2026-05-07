<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new location.
 *
 * Executes the official Avalara AvaTax REST API operation CreateLocations.
 */
class AvalaraCreateLocations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_locations';
}