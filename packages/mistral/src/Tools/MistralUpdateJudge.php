<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update a Mistral observability judge.
 */
class MistralUpdateJudge extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_judge';
    protected const DESCRIPTION = 'Update a Mistral observability judge.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/observability/judges/{judge_id}';
    protected const PATH_PARAMS = ['judge_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['judge_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral judge_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
