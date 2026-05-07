<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete custom rule. Requires the 'Administer Quality Profiles' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/rules/delete.
 */
class SonarQubeRulesDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_rules_delete';
    protected const DESCRIPTION = 'Delete custom rule. Requires the \'Administer Quality Profiles\' permission

Official SonarQube Web API endpoint: POST /api/rules/delete.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Rule key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/rules/delete';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
