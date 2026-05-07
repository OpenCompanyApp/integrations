<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Cancel an in progress batch.
 *
 * Executes the official Avalara AvaTax REST API operation CancelBatch.
 */
class AvalaraCancelBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_cancel_batch';
}