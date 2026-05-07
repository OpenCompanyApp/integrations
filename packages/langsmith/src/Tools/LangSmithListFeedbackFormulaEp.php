<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Feedback Formula Ep.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback/formulas.
 */
class LangSmithListFeedbackFormulaEp extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_feedback_formula_ep';
    protected const DESCRIPTION = 'List Feedback Formula Ep

Official endpoint: GET /api/v1/feedback/formulas
List feedback formulas for a given dataset or tracing project';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: dataset_id, session_id, limit, offset.',
  ),
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset_id`.',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session_id`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback/formulas';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'dataset_id',
  1 => 'session_id',
  2 => 'limit',
  3 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
