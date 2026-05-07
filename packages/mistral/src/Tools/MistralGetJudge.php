<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral observability judge.
 */
class MistralGetJudge extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_judge';
    protected const DESCRIPTION = 'Get a Mistral observability judge.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/judges/{judge_id}';
    protected const PATH_PARAMS = ['judge_id'];
    protected const PARAMETERS = ['judge_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral judge_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
