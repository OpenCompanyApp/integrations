<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Unset any manually-set New Code Period baseline on a project or a long-lived branch. Unsetting a manual baseline restores the use of the `sonar.leak.period` setting. Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_analyses/unset_baseline.
 */
class SonarCloudProjectAnalysesUnsetBaseline extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_analyses_unset_baseline';
    protected const DESCRIPTION = 'Unset any manually-set New Code Period baseline on a project or a long-lived branch. Unsetting a manual baseline restores the use of the `sonar.leak.period` setting. Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/project_analyses/unset_baseline.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_analyses/unset_baseline';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
    );
}
