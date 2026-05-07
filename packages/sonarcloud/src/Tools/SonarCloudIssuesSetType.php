<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Change type of issue, for instance from 'code smell' to 'bug'. Requires the following permissions: - 'Authentication'; - 'Browse' rights on project of the specified issue; - 'Administer Issues' rights on project of the specified issue;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/set_type.
 */
class SonarCloudIssuesSetType extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_set_type';
    protected const DESCRIPTION = 'Change type of issue, for instance from \'code smell\' to \'bug\'. Requires the following permissions: - \'Authentication\'; - \'Browse\' rights on project of the specified issue; - \'Administer Issues\' rights on project of the specified issue;

Official SonarCloud Web API endpoint: POST /api/issues/set_type.

Deprecated since SonarCloud 25 Aug, 2023; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'New type',
        'required' => true,
        'enum' => array (
          'CODE_SMELL',
          'BUG',
          'VULNERABILITY',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/set_type';
    protected const PARAM_MAP = array (
      'issue' => 'issue',
      'type' => 'type',
    );
}
