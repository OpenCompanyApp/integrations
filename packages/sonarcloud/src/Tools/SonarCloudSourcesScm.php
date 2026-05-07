<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get SCM information of source files. Require See Source Code permission on file's project Each element of the result array is composed of:- Line number; - Author of the commit; - Datetime of the commit (before 5.2 it was only the Date); - Revision of the commit (added in 5.2);.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/sources/scm.
 */
class SonarCloudSourcesScm extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_sources_scm';
    protected const DESCRIPTION = 'Get SCM information of source files. Require See Source Code permission on file\'s project Each element of the result array is composed of:- Line number; - Author of the commit; - Datetime of the commit (before 5.2 it was only the Date); - Revision of the commit (added in 5.2);

Official SonarCloud Web API endpoint: GET /api/sources/scm.';
    protected const PARAMETERS = array (
      'commits_by_line' => array (
        'type' => 'string',
        'description' => 'Group lines by SCM commit if value is false, else display commits for each line, even if two consecutive lines relate to the same commit.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'First line to return. Starts at 1',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'File key',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Last line to return (inclusive)',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/sources/scm';
    protected const PARAM_MAP = array (
      'commits_by_line' => 'commits_by_line',
      'from' => 'from',
      'key' => 'key',
      'to' => 'to',
    );
}
