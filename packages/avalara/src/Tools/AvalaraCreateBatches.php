<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new batch.
 *
 * Executes the official Avalara AvaTax REST API operation CreateBatches.
 */
class AvalaraCreateBatches extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_batches';
}