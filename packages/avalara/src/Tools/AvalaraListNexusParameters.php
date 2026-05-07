<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve parameters for a nexus.
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusParameters.
 */
class AvalaraListNexusParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_parameters';
}