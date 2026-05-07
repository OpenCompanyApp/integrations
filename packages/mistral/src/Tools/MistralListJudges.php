<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral observability judges.
 */
class MistralListJudges extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_judges';
    protected const DESCRIPTION = 'List Mistral observability judges.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/judges';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
