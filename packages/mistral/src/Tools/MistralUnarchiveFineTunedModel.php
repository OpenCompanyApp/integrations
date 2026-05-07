<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Unarchive a Mistral fine-tuned model.
 */
class MistralUnarchiveFineTunedModel extends AbstractMistralTool
{
    protected const NAME = 'mistral_unarchive_fine_tuned_model';
    protected const DESCRIPTION = 'Unarchive a Mistral fine-tuned model.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/fine_tuning/models/{model_id}/archive';
    protected const PATH_PARAMS = ['model_id'];
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fine-tuned model ID.']];
}
