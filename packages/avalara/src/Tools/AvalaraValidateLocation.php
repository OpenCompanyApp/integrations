<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Validate the location against local requirements.
 *
 * Executes the official Avalara AvaTax REST API operation ValidateLocation.
 */
class AvalaraValidateLocation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_validate_location';
}