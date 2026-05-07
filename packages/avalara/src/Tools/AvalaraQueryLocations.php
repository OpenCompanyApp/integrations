<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all locations.
 *
 * Executes the official Avalara AvaTax REST API operation QueryLocations.
 */
class AvalaraQueryLocations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_locations';
}