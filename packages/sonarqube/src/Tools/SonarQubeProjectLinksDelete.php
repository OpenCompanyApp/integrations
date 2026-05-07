<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete existing project link. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_links/delete.
 */
class SonarQubeProjectLinksDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_links_delete';
    protected const DESCRIPTION = 'Delete existing project link. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarQube Web API endpoint: POST /api/project_links/delete.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Link id',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_links/delete';
    protected const PARAM_MAP = array (
      'id' => 'id',
    );
}
