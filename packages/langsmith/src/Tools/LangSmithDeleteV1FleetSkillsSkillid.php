<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a skill.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/fleet/skills/{skillID}.
 */
class LangSmithDeleteV1FleetSkillsSkillid extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_fleet_skills_skillid';
    protected const DESCRIPTION = 'Delete a skill

Official endpoint: DELETE /v1/fleet/skills/{skillID}
Deletes the skill and all of its files. Idempotent: deleting an already-deleted skill returns 204.';
    protected const PARAMETERS = array (
  'skillID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `skillID`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/fleet/skills/{skillID}';
    protected const PATH_PARAMS = array (
  0 => 'skillID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
