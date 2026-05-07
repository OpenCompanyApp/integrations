<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Create a Cerebras batch.
 */
class CerebrasCreateBatch extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_create_batch';
    protected const DESCRIPTION = 'Create a Cerebras batch.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/batches';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.']];
}
