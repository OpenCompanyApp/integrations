<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a custom rule. Requires the 'Administer Quality Profiles' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/rules/create.
 */
class SonarQubeRulesCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_rules_create';
    protected const DESCRIPTION = 'Create a custom rule. Requires the \'Administer Quality Profiles\' permission

Official SonarQube Web API endpoint: POST /api/rules/create.';
    protected const PARAMETERS = array (
      'clean_code_attribute' => array (
        'type' => 'string',
        'description' => 'Clean code attribute',
        'required' => false,
        'enum' => array (
          'CONVENTIONAL',
          'FORMATTED',
          'IDENTIFIABLE',
          'CLEAR',
          'COMPLETE',
          'EFFICIENT',
          'LOGICAL',
          'DISTINCT',
          'FOCUSED',
          'MODULAR',
          'TESTED',
          'LAWFUL',
          'RESPECTFUL',
          'TRUSTWORTHY',
        ),
      ),
      'custom_key' => array (
        'type' => 'string',
        'description' => 'Key of the custom rule',
        'required' => true,
      ),
      'impacts' => array (
        'type' => 'string',
        'description' => 'Impacts as semi-colon list of =',
        'required' => false,
      ),
      'markdown_description' => array (
        'type' => 'string',
        'description' => 'Rule description in markdown format',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Rule name',
        'required' => true,
      ),
      'params' => array (
        'type' => 'string',
        'description' => 'Parameters as semi-colon list of =',
        'required' => false,
      ),
      'prevent_reactivation' => array (
        'type' => 'string',
        'description' => 'If set to true and if the rule has been deactivated (status \'REMOVED\'), a status 409 will be returned',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'severity' => array (
        'type' => 'string',
        'description' => 'Rule severity',
        'required' => false,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
      'status' => array (
        'type' => 'string',
        'description' => 'Rule status',
        'required' => false,
        'enum' => array (
          'BETA',
          'DEPRECATED',
          'READY',
        ),
      ),
      'template_key' => array (
        'type' => 'string',
        'description' => 'Key of the template rule in order to create a custom rule',
        'required' => true,
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'Rule type',
        'required' => false,
        'enum' => array (
          'CODE_SMELL',
          'BUG',
          'VULNERABILITY',
          'SECURITY_HOTSPOT',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/rules/create';
    protected const PARAM_MAP = array (
      'cleanCodeAttribute' => 'clean_code_attribute',
      'customKey' => 'custom_key',
      'impacts' => 'impacts',
      'markdownDescription' => 'markdown_description',
      'name' => 'name',
      'params' => 'params',
      'preventReactivation' => 'prevent_reactivation',
      'severity' => 'severity',
      'status' => 'status',
      'templateKey' => 'template_key',
      'type' => 'type',
    );
}
