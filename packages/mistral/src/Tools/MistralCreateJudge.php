<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral observability judge.
 */
class MistralCreateJudge extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_judge';
    protected const DESCRIPTION = 'Create a Mistral observability judge.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/judges';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
