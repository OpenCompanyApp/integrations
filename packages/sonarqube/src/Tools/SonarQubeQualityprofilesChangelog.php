<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the history of changes on a quality profile: rule activation/deactivation, change in parameters/severity/impacts. Events are ordered by date in descending order (most recent first)..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/changelog.
 */
class SonarQubeQualityprofilesChangelog extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_changelog';
    protected const DESCRIPTION = 'Get the history of changes on a quality profile: rule activation/deactivation, change in parameters/severity/impacts. Events are ordered by date in descending order (most recent first).

Official SonarQube Web API endpoint: GET /api/qualityprofiles/changelog.';
    protected const PARAMETERS = array (
      'filter_mode' => array (
        'type' => 'string',
        'description' => 'If specified, will return changelog events related to MQR or STANDARD mode. If not specified, all the events are returned',
        'required' => false,
        'enum' => array (
          'STANDARD',
          'MQR',
        ),
      ),
      'language' => array (
        'type' => 'string',
        'description' => 'Quality profile language.',
        'required' => true,
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
          'dart',
          'rust',
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
          'go',
          'kotlin',
          'rpg',
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
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name.',
        'required' => true,
      ),
      'since' => array (
        'type' => 'string',
        'description' => 'Start date for the changelog (inclusive). Either a date (server timezone) or datetime can be provided.',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'End date for the changelog (exclusive, strictly before). Either a date (server timezone) or datetime can be provided.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/changelog';
    protected const PARAM_MAP = array (
      'filterMode' => 'filter_mode',
      'language' => 'language',
      'p' => 'p',
      'ps' => 'ps',
      'qualityProfile' => 'quality_profile',
      'since' => 'since',
      'to' => 'to',
    );
}
