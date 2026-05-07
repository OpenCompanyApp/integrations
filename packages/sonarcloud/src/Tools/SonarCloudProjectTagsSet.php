<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Set tags on a project. Requires the following permission: 'Administer' rights on the specified project.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_tags/set.
 */
class SonarCloudProjectTagsSet extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_tags_set';
    protected const DESCRIPTION = 'Set tags on a project. Requires the following permission: \'Administer\' rights on the specified project

Official SonarCloud Web API endpoint: POST /api/project_tags/set.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'tags' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of tags',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_tags/set';
    protected const PARAM_MAP = array (
      'project' => 'project',
      'tags' => 'tags',
    );
}
