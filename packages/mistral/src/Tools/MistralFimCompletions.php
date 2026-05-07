<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral fill-in-the-middle completion.
 */
class MistralFimCompletions extends AbstractMistralTool
{
    protected const NAME = 'mistral_fim_completions';
    protected const DESCRIPTION = 'Create a Mistral FIM completion using /v1/fim/completions.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fim/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'FIM completion body with model, prompt, suffix, and generation options.']];
}
