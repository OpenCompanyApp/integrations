<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new UPC.
 *
 * Executes the official Avalara AvaTax REST API operation CreateUPCs.
 */
class AvalaraCreateUPCs extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_up_cs';
}