<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single override.
 *
 * Executes the official Avalara AvaTax REST API operation GetJurisdictionOverride.
 */
class AvalaraGetJurisdictionOverride extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_jurisdiction_override';
}