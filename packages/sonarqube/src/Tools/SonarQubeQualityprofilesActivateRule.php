<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Activate a rule on a Quality Profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/activate_rule.
 */
class SonarQubeQualityprofilesActivateRule extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_activate_rule';
    protected const DESCRIPTION = 'Activate a rule on a Quality Profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarQube Web API endpoint: POST /api/qualityprofiles/activate_rule.';
    protected const PARAMETERS = array (
      'impacts' => array (
        'type' => 'string',
        'description' => 'Override of impact severities for the rule. Cannot be used as the same time as \'severity\'. Ignored if parameter reset is true.',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Quality Profile key. Can be obtained through api/qualityprofiles/search',
        'required' => true,
      ),
      'params' => array (
        'type' => 'string',
        'description' => 'Parameters as semi-colon list of key=value. Ignored if parameter reset is true.',
        'required' => false,
      ),
      'prioritized_rule' => array (
        'type' => 'string',
        'description' => 'Mark activated rule as prioritized, so all corresponding Issues will have to be fixed.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'reset' => array (
        'type' => 'string',
        'description' => 'Reset severity and parameters of activated rule. Set the values defined on parent profile or from rule default values.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'rule' => array (
        'type' => 'string',
        'description' => 'Rule key',
        'required' => true,
      ),
      'severity' => array (
        'type' => 'string',
        'description' => 'Severity. Cannot be used as the same time as \'impacts\'.Ignored if parameter reset is true.',
        'required' => false,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/activate_rule';
    protected const PARAM_MAP = array (
      'impacts' => 'impacts',
      'key' => 'key',
      'params' => 'params',
      'prioritizedRule' => 'prioritized_rule',
      'reset' => 'reset',
      'rule' => 'rule',
      'severity' => 'severity',
    );
}
