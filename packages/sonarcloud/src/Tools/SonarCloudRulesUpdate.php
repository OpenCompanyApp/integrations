<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Update an existing rule. Requires the 'Administer Quality Profiles' permission.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/rules/update.
 */
class SonarCloudRulesUpdate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_rules_update';
    protected const DESCRIPTION = 'Update an existing rule. Requires the \'Administer Quality Profiles\' permission

Official SonarCloud Web API endpoint: POST /api/rules/update.';
    protected const PARAMETERS = array (
      'debt_sub_characteristic' => array (
        'type' => 'string',
        'description' => 'Debt characteristics are no more supported. This parameter is ignored.',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Key of the rule to update',
        'required' => true,
      ),
      'markdown_description' => array (
        'type' => 'string',
        'description' => 'Rule description (mandatory for custom rule and manual rule)',
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
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => true,
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
      'debt_sub_characteristic' => 'debt_sub_characteristic',
      'key' => 'key',
      'markdown_description' => 'markdown_description',
      'markdown_note' => 'markdown_note',
      'name' => 'name',
      'organization' => 'organization',
      'params' => 'params',
      'remediation_fn_base_effort' => 'remediation_fn_base_effort',
      'remediation_fn_type' => 'remediation_fn_type',
      'remediation_fy_gap_multiplier' => 'remediation_fy_gap_multiplier',
      'severity' => 'severity',
      'status' => 'status',
      'tags' => 'tags',
    );
}
