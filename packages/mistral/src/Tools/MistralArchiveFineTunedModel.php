<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Archive a Mistral fine-tuned model.
 */
class MistralArchiveFineTunedModel extends AbstractMistralTool
{
    protected const NAME = 'mistral_archive_fine_tuned_model';
    protected const DESCRIPTION = 'Archive a Mistral fine-tuned model.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fine_tuning/models/{model_id}/archive';
    protected const PATH_PARAMS = ['model_id'];
    protected const PARAMETERS = ['model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fine-tuned model ID.']];
}
