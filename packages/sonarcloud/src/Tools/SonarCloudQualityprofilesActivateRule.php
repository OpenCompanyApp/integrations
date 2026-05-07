<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Activate a rule on a Quality Profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/activate_rule.
 */
class SonarCloudQualityprofilesActivateRule extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_activate_rule';
    protected const DESCRIPTION = 'Activate a rule on a Quality Profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/activate_rule.';
    protected const PARAMETERS = array (
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
        'description' => 'Severity. Ignored if parameter reset is true.',
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
      'key' => 'key',
      'params' => 'params',
      'reset' => 'reset',
      'rule' => 'rule',
      'severity' => 'severity',
    );
}
