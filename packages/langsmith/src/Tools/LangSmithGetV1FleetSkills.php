<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List skills.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/skills.
 */
class LangSmithGetV1FleetSkills extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_skills';
    protected const DESCRIPTION = 'List skills

Official endpoint: GET /v1/fleet/skills
Returns the skills in the caller\'s workspace, paginated.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: page_size, cursor.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `page_size`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `cursor`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/skills';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'page_size',
  1 => 'cursor',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
