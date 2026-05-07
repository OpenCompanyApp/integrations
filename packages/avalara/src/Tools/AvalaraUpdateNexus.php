<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single nexus.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateNexus.
 */
class AvalaraUpdateNexus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_nexus';
}