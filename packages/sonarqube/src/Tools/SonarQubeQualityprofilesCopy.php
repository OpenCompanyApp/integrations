<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Copy a quality profile. Requires to be logged in and the 'Administer Quality Profiles' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/copy.
 */
class SonarQubeQualityprofilesCopy extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_copy';
    protected const DESCRIPTION = 'Copy a quality profile. Requires to be logged in and the \'Administer Quality Profiles\' permission.

Official SonarQube Web API endpoint: POST /api/qualityprofiles/copy.';
    protected const PARAMETERS = array (
      'from_key' => array (
        'type' => 'string',
        'description' => 'Quality profile key',
        'required' => true,
      ),
      'to_name' => array (
        'type' => 'string',
        'description' => 'Name for the new quality profile.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/copy';
    protected const PARAM_MAP = array (
      'fromKey' => 'from_key',
      'toName' => 'to_name',
    );
}
