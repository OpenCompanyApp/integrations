<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a nexus parameter.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateNexusParameter.
 */
class AvalaraUpdateNexusParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_nexus_parameter';
}