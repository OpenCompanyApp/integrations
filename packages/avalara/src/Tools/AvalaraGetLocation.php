<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single location.
 *
 * Executes the official Avalara AvaTax REST API operation GetLocation.
 */
class AvalaraGetLocation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_location';
}