<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete existing project link. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_links/delete.
 */
class SonarCloudProjectLinksDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_links_delete';
    protected const DESCRIPTION = 'Delete existing project link. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarCloud Web API endpoint: POST /api/project_links/delete.';
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
