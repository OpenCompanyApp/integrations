<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List rule tags.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/rules/tags.
 */
class SonarCloudRulesTags extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_rules_tags';
    protected const DESCRIPTION = 'List rule tags

Official SonarCloud Web API endpoint: GET /api/rules/tags.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => true,
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
    protected const PATH = '/api/rules/tags';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'ps' => 'ps',
      'q' => 'q',
    );
}
