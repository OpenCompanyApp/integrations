<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update an existing rule. Requires the 'Administer Quality Profiles' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/rules/update.
 */
class SonarQubeRulesUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_rules_update';
    protected const DESCRIPTION = 'Update an existing rule. Requires the \'Administer Quality Profiles\' permission

Official SonarQube Web API endpoint: POST /api/rules/update.';
    protected const PARAMETERS = array (
      'impacts' => array (
        'type' => 'string',
        'description' => 'Rule impacts, semicolon-separated (Only when updating a custom rule impact severity)',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Key of the rule to update',
        'required' => true,
      ),
      'markdown_description' => array (
        'type' => 'string',
        'description' => 'Rule description (mandatory for custom rule and manual rule) in markdown format',
        'required' => false,
      ),
      'markdown_note' => array (
        'type' => 'string',
        'description' => 'Optional note in markdown format. Use empty value to remove current note. Note is not changed if the parameter is not set.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Rule name (mandatory for custom rule)',
        'required' => false,
      ),
      'params' => array (
        'type' => 'string',
        'description' => 'Parameters as semi-colon list of =, for example \'params=key1=v1;key2=v2\' (Only when updating a custom rule)',
        'required' => false,
      ),
      'remediation_fn_base_effort' => array (
        'type' => 'string',
        'description' => 'Base effort of the remediation function of the rule',
        'required' => false,
      ),
      'remediation_fn_type' => array (
        'type' => 'string',
        'description' => 'Type of the remediation function of the rule',
        'required' => false,
        'enum' => array (
          'LINEAR',
          'LINEAR_OFFSET',
          'CONSTANT_ISSUE',
        ),
      ),
      'remediation_fy_gap_multiplier' => array (
        'type' => 'string',
        'description' => 'Gap multiplier of the remediation function of the rule',
        'required' => false,
      ),
      'severity' => array (
        'type' => 'string',
        'description' => 'Rule severity (Only when updating a custom rule)',
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
        'description' => 'Rule status (Only when updating a custom rule)',
        'required' => false,
        'enum' => array (
          'BETA',
          'DEPRECATED',
          'READY',
          'REMOVED',
        ),
      ),
      'tags' => array (
        'type' => 'string',
        'description' => 'Optional comma-separated list of tags to set. Use blank value to remove current tags. Tags are not changed if the parameter is not set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/rules/update';
    protected const PARAM_MAP = array (
      'impacts' => 'impacts',
      'key' => 'key',
      'markdownDescription' => 'markdown_description',
      'markdown_note' => 'markdown_note',
      'name' => 'name',
      'params' => 'params',
      'remediation_fn_base_effort' => 'remediation_fn_base_effort',
      'remediation_fn_type' => 'remediation_fn_type',
      'remediation_fy_gap_multiplier' => 'remediation_fy_gap_multiplier',
      'severity' => 'severity',
      'status' => 'status',
      'tags' => 'tags',
    );
}
