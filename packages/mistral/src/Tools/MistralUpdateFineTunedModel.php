<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update metadata for a Mistral fine-tuned model.
 */
class MistralUpdateFineTunedModel extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_fine_tuned_model';
    protected const DESCRIPTION = 'Patch metadata for a Mistral fine-tuned model.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/fine_tuning/models/{model_id}';
    protected const PATH_PARAMS = ['model_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fine-tuned model ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Fine-tuned model update body.']];
}
