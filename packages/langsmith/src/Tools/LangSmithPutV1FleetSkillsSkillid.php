<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Replace a skill.
 *
 * Maps to the official LangSmith endpoint PUT /v1/fleet/skills/{skillID}.
 */
class LangSmithPutV1FleetSkillsSkillid extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_v1_fleet_skills_skillid';
    protected const DESCRIPTION = 'Replace a skill

Official endpoint: PUT /v1/fleet/skills/{skillID}
Replaces the skill\'s file tree in full. Any file present in the current skill but absent from the request body is deleted. The call is atomic; on validation failure no changes are applied.';
    protected const PARAMETERS = array (
  'skillID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `skillID`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/fleet/skills/{skillID}';
    protected const PATH_PARAMS = array (
  0 => 'skillID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
