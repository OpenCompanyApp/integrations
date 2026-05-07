<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add parameters to a nexus..
 *
 * Executes the official Avalara AvaTax REST API operation CreateNexusParameters.
 */
class AvalaraCreateNexusParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_nexus_parameters';
}