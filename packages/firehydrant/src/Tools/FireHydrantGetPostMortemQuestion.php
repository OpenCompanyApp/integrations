<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a retrospective question.
 *
 * Maps to the official FireHydrant endpoint get /v1/post_mortems/questions/{question_id}.
 */
class FireHydrantGetPostMortemQuestion extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_post_mortem_question';
    protected const DESCRIPTION = 'Get a retrospective question

Official FireHydrant endpoint: GET /v1/post_mortems/questions/{question_id}

Get an incident retrospective question configured to be provided and filled out on each retrospective report.';
    protected const PARAMETERS = array (
  'question_id' =>
  array (
    'type' => 'string',
    'description' => 'question_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems/questions/{question_id}';
    protected const PATH_PARAMS = array (
  'question_id' => 'question_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
