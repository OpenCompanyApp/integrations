<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Change severity. Requires the following permissions: - 'Authentication'; - 'Browse' rights on project of the specified issue; - 'Administer Issues' rights on project of the specified issue;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/set_severity.
 */
class SonarCloudIssuesSetSeverity extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_set_severity';
    protected const DESCRIPTION = 'Change severity. Requires the following permissions: - \'Authentication\'; - \'Browse\' rights on project of the specified issue; - \'Administer Issues\' rights on project of the specified issue;

Official SonarCloud Web API endpoint: POST /api/issues/set_severity.

Deprecated since SonarCloud 25 Aug, 2023; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
      'severity' => array (
        'type' => 'string',
        'description' => 'New severity',
        'required' => true,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/set_severity';
    protected const PARAM_MAP = array (
      'issue' => 'issue',
      'severity' => 'severity',
    );
}
