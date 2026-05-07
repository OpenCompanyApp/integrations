<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update retrospective questions.
 *
 * Maps to the official FireHydrant endpoint put /v1/post_mortems/questions.
 */
class FireHydrantUpdatePostMortemQuestions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_post_mortem_questions';
    protected const DESCRIPTION = 'Update retrospective questions

Official FireHydrant endpoint: PUT /v1/post_mortems/questions

Update the questions configured to be provided and filled out on future retrospective reports.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/post_mortems/questions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
