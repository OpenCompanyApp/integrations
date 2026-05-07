<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List tags matching a given query.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/issues/tags.
 */
class SonarCloudIssuesTags extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_tags';
    protected const DESCRIPTION = 'List tags matching a given query

Official SonarCloud Web API endpoint: GET /api/issues/tags.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 100',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to tags that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/issues/tags';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'project' => 'project',
      'ps' => 'ps',
      'q' => 'q',
    );
}
