<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create Completion.
 */
class FireworksAiPostCompletions extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_completions';
    protected const DESCRIPTION = 'Create text completion.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
