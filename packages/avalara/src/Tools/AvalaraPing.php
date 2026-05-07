<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Tests connectivity and version of the service.
 *
 * Executes the official Avalara AvaTax REST API operation Ping.
 */
class AvalaraPing extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_ping';
}