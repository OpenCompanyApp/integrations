<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral model.
 */
class MistralDeleteModel extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_model';
    protected const DESCRIPTION = 'Delete a Mistral model by model_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/models/{model_id}';
    protected const PATH_PARAMS = ['model_id'];
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral model ID.']];
}
