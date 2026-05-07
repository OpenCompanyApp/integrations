<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all batches.
 *
 * Executes the official Avalara AvaTax REST API operation QueryBatches.
 */
class AvalaraQueryBatches extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_batches';
}