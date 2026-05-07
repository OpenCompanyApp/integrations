<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve a Cerebras batch.
 */
class CerebrasRetrieveBatch extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_batch';
    protected const DESCRIPTION = 'Retrieve a Cerebras batch.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/batches/{batch_id}';
    protected const PATH_PARAMS = ['batch_id'];
    protected const PARAMETERS = ['batch_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras batch_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
