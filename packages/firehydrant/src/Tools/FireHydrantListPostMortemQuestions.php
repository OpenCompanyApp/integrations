<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List retrospective questions.
 *
 * Maps to the official FireHydrant endpoint get /v1/post_mortems/questions.
 */
class FireHydrantListPostMortemQuestions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_post_mortem_questions';
    protected const DESCRIPTION = 'List retrospective questions

Official FireHydrant endpoint: GET /v1/post_mortems/questions

List the questions configured to be provided and filled out on each retrospective report.';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems/questions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
