<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set tags on an issue. Requires authentication and Browse permission on project.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/set_tags.
 */
class SonarQubeIssuesSetTags extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_set_tags';
    protected const DESCRIPTION = 'Set tags on an issue. Requires authentication and Browse permission on project

Official SonarQube Web API endpoint: POST /api/issues/set_tags.';
    protected const PARAMETERS = array (
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
      'tags' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of tags. All tags are removed if parameter is empty or not set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/set_tags';
    protected const PARAM_MAP = array (
      'issue' => 'issue',
      'tags' => 'tags',
    );
}
