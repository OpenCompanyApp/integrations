<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Eagerly Create Feedback.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/feedback/eager.
 */
class LangSmithEagerlyCreateFeedback extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_eagerly_create_feedback';
    protected const DESCRIPTION = 'Eagerly Create Feedback

Official endpoint: POST /api/v1/feedback/eager
Create a new feedback. This method is invoked under the assumption that the run is already visible in the app, thus already present in DB';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/feedback/eager';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
