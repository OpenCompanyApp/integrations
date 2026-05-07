<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single batch.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteBatch.
 */
class AvalaraDeleteBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_batch';
}