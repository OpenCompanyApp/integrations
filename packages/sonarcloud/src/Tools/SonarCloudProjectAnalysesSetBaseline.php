<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Set an analysis as the baseline of the New Code Period on a project or a long-lived branch. This manually set baseline overrides the `sonar.leak.period` setting. Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_analyses/set_baseline.
 */
class SonarCloudProjectAnalysesSetBaseline extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_analyses_set_baseline';
    protected const DESCRIPTION = 'Set an analysis as the baseline of the New Code Period on a project or a long-lived branch. This manually set baseline overrides the `sonar.leak.period` setting. Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/project_analyses/set_baseline.';
    protected const PARAMETERS = array (
      'analysis' => array (
        'type' => 'string',
        'description' => 'Analysis key',
        'required' => true,
      ),
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
    protected const PATH = '/api/project_analyses/set_baseline';
    protected const PARAM_MAP = array (
      'analysis' => 'analysis',
      'branch' => 'branch',
      'project' => 'project',
    );
}
