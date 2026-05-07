<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all nexus.
 *
 * Executes the official Avalara AvaTax REST API operation QueryNexus.
 */
class AvalaraQueryNexus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_nexus';
}