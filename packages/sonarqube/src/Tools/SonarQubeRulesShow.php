<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get detailed information about a rule.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/rules/show.
 */
class SonarQubeRulesShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_rules_show';
    protected const DESCRIPTION = 'Get detailed information about a rule

Official SonarQube Web API endpoint: GET /api/rules/show.';
    protected const PARAMETERS = array (
      'actives' => array (
        'type' => 'string',
        'description' => 'Show rule\'s activations for all profiles ("active rules")',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Rule key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/rules/show';
    protected const PARAM_MAP = array (
      'actives' => 'actives',
      'key' => 'key',
    );
}
