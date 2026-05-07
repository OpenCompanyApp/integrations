<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Rename a quality profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/rename.
 */
class SonarCloudQualityprofilesRename extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_rename';
    protected const DESCRIPTION = 'Rename a quality profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/rename.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Quality profile key',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New quality profile name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/rename';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'name' => 'name',
    );
}
