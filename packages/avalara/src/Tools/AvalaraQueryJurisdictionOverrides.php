<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all overrides.
 *
 * Executes the official Avalara AvaTax REST API operation QueryJurisdictionOverrides.
 */
class AvalaraQueryJurisdictionOverrides extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_jurisdiction_overrides';
}