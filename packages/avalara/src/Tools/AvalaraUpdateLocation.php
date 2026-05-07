<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single location.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateLocation.
 */
class AvalaraUpdateLocation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_location';
}