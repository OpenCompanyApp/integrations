<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Backup a quality profile in XML form. The exported profile can be restored through api/qualityprofiles/restore..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualityprofiles/backup.
 */
class SonarCloudQualityprofilesBackup extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_backup';
    protected const DESCRIPTION = 'Backup a quality profile in XML form. The exported profile can be restored through api/qualityprofiles/restore.

Official SonarCloud Web API endpoint: GET /api/qualityprofiles/backup.';
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
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name. Mandatory if \'key\' is not set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/backup';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'language' => 'language',
      'organization' => 'organization',
      'qualityProfile' => 'quality_profile',
    );
}
