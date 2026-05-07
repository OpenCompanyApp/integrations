<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a new project link. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_links/create.
 */
class SonarQubeProjectLinksCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_links_create';
    protected const DESCRIPTION = 'Create a new project link. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarQube Web API endpoint: POST /api/project_links/create.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Link name',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project id',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'Link url',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_links/create';
    protected const PARAM_MAP = array (
      'name' => 'name',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
      'url' => 'url',
    );
}
