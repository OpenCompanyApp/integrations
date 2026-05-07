<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List available rule repositories.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/rules/repositories.
 */
class SonarCloudRulesRepositories extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_rules_repositories';
    protected const DESCRIPTION = 'List available rule repositories

Official SonarCloud Web API endpoint: GET /api/rules/repositories.';
    protected const PARAMETERS = array (
      'language' => array (
        'type' => 'string',
        'description' => 'A language key; if provided, only repositories for the given language will be returned',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'A pattern to match repository keys/names against',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/rules/repositories';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'q' => 'q',
    );
}
