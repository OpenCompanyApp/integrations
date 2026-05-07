<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Cancel a Cerebras batch.
 */
class CerebrasCancelBatch extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_cancel_batch';
    protected const DESCRIPTION = 'Cancel a Cerebras batch.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/batches/{batch_id}';
    protected const PATH_PARAMS = ['batch_id'];
    protected const PARAMETERS = ['batch_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras batch_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
