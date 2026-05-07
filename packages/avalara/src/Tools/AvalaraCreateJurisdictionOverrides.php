<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create one or more overrides.
 *
 * Executes the official Avalara AvaTax REST API operation CreateJurisdictionOverrides.
 */
class AvalaraCreateJurisdictionOverrides extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_jurisdiction_overrides';
}