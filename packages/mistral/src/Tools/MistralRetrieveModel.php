<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve metadata for a Mistral model.
 */
class MistralRetrieveModel extends AbstractMistralTool
{
    protected const NAME = 'mistral_retrieve_model';
    protected const DESCRIPTION = 'Retrieve metadata for a Mistral model by model_id.';
    protected const PATH = '/v1/models/{model_id}';
    protected const PATH_PARAMS = ['model_id'];
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral model ID.']];
}
