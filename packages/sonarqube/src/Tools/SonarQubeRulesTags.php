<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List rule tags.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/rules/tags.
 */
class SonarQubeRulesTags extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_rules_tags';
    protected const DESCRIPTION = 'List rule tags

Official SonarQube Web API endpoint: GET /api/rules/tags.';
    protected const PARAMETERS = array (
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
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
      'ps' => 'ps',
      'q' => 'q',
    );
}
