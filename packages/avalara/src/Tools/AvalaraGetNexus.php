<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single nexus.
 *
 * Executes the official Avalara AvaTax REST API operation GetNexus.
 */
class AvalaraGetNexus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_nexus';
}