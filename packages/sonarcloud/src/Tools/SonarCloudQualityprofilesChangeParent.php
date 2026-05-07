<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Change a quality profile's parent. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/change_parent.
 */
class SonarCloudQualityprofilesChangeParent extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_change_parent';
    protected const DESCRIPTION = 'Change a quality profile\'s parent. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/change_parent.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Quality profile key. Mandatory unless \'qualityProfile\' and \'language\' are specified.',
        'required' => false,
      ),
      'language' => array (
        'type' => 'string',
        'description' => 'Quality profile language. Mandatory if \'key\' is not set.',
        'required' => false,
        'enum' => array (
          'kubernetes',
          'css',
          'scala',
          'jsp',
          'py',
          'js',
          'plsql',
          'apex',
          'docker',
          'ansible',
          'rust',
          'dart',
          'jcl',
          'java',
          'web',
          'xml',
          'flex',
          'powershell',
          'json',
          'ipynb',
          'text',
          'vbnet',
          'azurepipelines',
          'cloudformation',
          'swift',
          'yaml',
          'cpp',
          'c',
          'kotlin',
          'rpg',
          'go',
          'vb',
          'tsql',
          'pli',
          'secrets',
          'ruby',
          'cs',
          'groovy',
          'cobol',
          'shell',
          'php',
          'terraform',
          'azureresourcemanager',
          'abap',
          'objc',
          'ts',
          'githubactions',
        ),
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => false,
      ),
      'parent_key' => array (
        'type' => 'string',
        'description' => 'New parent profile key. If no profile is provided, the inheritance link with current parent profile (if any) is broken, which deactivates all rules which come from the parent and are not overridden.',
        'required' => false,
      ),
      'parent_quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name. If this parameter is set, \'parentKey\' must not be set and \'language\' must be set to disambiguate.',
        'required' => false,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name. Mandatory if \'key\' is not set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/change_parent';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'language' => 'language',
      'organization' => 'organization',
      'parentKey' => 'parent_key',
      'parentQualityProfile' => 'parent_quality_profile',
      'qualityProfile' => 'quality_profile',
    );
}
