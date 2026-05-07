<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Deactivate a rule on a quality profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/deactivate_rule.
 */
class SonarCloudQualityprofilesDeactivateRule extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_deactivate_rule';
    protected const DESCRIPTION = 'Deactivate a rule on a quality profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/deactivate_rule.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Quality Profile key. Can be obtained through api/qualityprofiles/search',
        'required' => true,
      ),
      'rule' => array (
        'type' => 'string',
        'description' => 'Rule key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/deactivate_rule';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'rule' => 'rule',
    );
}
