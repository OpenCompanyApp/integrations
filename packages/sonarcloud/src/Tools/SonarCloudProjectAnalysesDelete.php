<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a project analysis. Requires the permission 'Administer' on the project of the specified analysis..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_analyses/delete.
 */
class SonarCloudProjectAnalysesDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_analyses_delete';
    protected const DESCRIPTION = 'Delete a project analysis. Requires the permission \'Administer\' on the project of the specified analysis.

Official SonarCloud Web API endpoint: POST /api/project_analyses/delete.';
    protected const PARAMETERS = array (
      'analysis' => array (
        'type' => 'string',
        'description' => 'Analysis key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_analyses/delete';
    protected const PARAM_MAP = array (
      'analysis' => 'analysis',
    );
}
