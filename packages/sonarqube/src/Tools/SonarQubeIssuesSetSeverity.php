<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Change severity. Requires the following permissions: - 'Authentication'; - 'Browse' rights on project of the specified issue; - 'Administer Issues' rights on project of the specified issue;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/set_severity.
 */
class SonarQubeIssuesSetSeverity extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_set_severity';
    protected const DESCRIPTION = 'Change severity. Requires the following permissions: - \'Authentication\'; - \'Browse\' rights on project of the specified issue; - \'Administer Issues\' rights on project of the specified issue;

Official SonarQube Web API endpoint: POST /api/issues/set_severity.';
    protected const PARAMETERS = array (
      'impact' => array (
        'type' => 'string',
        'description' => 'Override of impact severity for the rule. Cannot be used as the same time as \'severity\'',
        'required' => false,
      ),
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
      'severity' => array (
        'type' => 'string',
        'description' => 'New severity',
        'required' => false,
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
      'impact' => 'impact',
      'issue' => 'issue',
      'severity' => 'severity',
    );
}
