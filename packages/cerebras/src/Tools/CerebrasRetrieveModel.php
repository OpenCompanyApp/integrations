<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve a Cerebras model.
 */
class CerebrasRetrieveModel extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_model';
    protected const DESCRIPTION = 'Retrieve a Cerebras model.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/models/{model_id}';
    protected const PATH_PARAMS = ['model_id'];
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
