<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single override.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteJurisdictionOverride.
 */
class AvalaraDeleteJurisdictionOverride extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_jurisdiction_override';
}