<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete all parameters for a nexus.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteNexusParameters.
 */
class AvalaraDeleteNexusParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_nexus_parameters';
}