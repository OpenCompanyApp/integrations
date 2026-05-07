<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all UPCs.
 *
 * Executes the official Avalara AvaTax REST API operation QueryUPCs.
 */
class AvalaraQueryUPCs extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_up_cs';
}