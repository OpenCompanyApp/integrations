<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single jurisdictionoverride.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateJurisdictionOverride.
 */
class AvalaraUpdateJurisdictionOverride extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_jurisdiction_override';
}