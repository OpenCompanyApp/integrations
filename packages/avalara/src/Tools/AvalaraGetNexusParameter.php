<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single nexus parameter.
 *
 * Executes the official Avalara AvaTax REST API operation GetNexusParameter.
 */
class AvalaraGetNexusParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_nexus_parameter';
}