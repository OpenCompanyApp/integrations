<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new nexus.
 *
 * Executes the official Avalara AvaTax REST API operation CreateNexus.
 */
class AvalaraCreateNexus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_nexus';
}