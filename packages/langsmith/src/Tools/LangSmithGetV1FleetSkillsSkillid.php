<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a skill.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/skills/{skillID}.
 */
class LangSmithGetV1FleetSkillsSkillid extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_skills_skillid';
    protected const DESCRIPTION = 'Get a skill

Official endpoint: GET /v1/fleet/skills/{skillID}
Returns the specified skill, including its full file tree.';
    protected const PARAMETERS = array (
  'skillID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `skillID`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/skills/{skillID}';
    protected const PATH_PARAMS = array (
  0 => 'skillID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
