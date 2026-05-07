<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral observability judge.
 */
class MistralDeleteJudge extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_judge';
    protected const DESCRIPTION = 'Delete a Mistral observability judge.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/observability/judges/{judge_id}';
    protected const PATH_PARAMS = ['judge_id'];
    protected const PARAMETERS = ['judge_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral judge_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
