<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve public Cerebras model metadata.
 */
class CerebrasRetrievePublicModel extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_public_model';
    protected const DESCRIPTION = 'Retrieve public Cerebras model metadata.';
    protected const METHOD = 'GET';
    protected const PATH = '/public/v1/models/{model_id}';
    protected const PATH_PARAMS = ['model_id'];
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
