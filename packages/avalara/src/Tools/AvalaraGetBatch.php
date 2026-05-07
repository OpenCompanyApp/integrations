<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single batch.
 *
 * Executes the official Avalara AvaTax REST API operation GetBatch.
 */
class AvalaraGetBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_batch';
}