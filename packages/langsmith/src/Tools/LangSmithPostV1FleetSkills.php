<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a skill.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/skills.
 */
class LangSmithPostV1FleetSkills extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_skills';
    protected const DESCRIPTION = 'Create a skill

Official endpoint: POST /v1/fleet/skills
Creates a workspace skill with the supplied file tree. Atomic: if the file commit fails, no repo is created.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/skills';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
