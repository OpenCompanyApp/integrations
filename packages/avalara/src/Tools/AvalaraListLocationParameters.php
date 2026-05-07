<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve parameters for a location.
 *
 * Executes the official Avalara AvaTax REST API operation ListLocationParameters.
 */
class AvalaraListLocationParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_location_parameters';
}