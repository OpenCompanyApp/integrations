<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Temporarily changes level of logs. New level is not persistent and is lost when restarting server. Requires system administration permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/system/change_log_level.
 */
class SonarQubeSystemChangeLogLevel extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_change_log_level';
    protected const DESCRIPTION = 'Temporarily changes level of logs. New level is not persistent and is lost when restarting server. Requires system administration permission.

Official SonarQube Web API endpoint: POST /api/system/change_log_level.';
    protected const PARAMETERS = array (
      'level' => array (
        'type' => 'string',
        'description' => 'The new level. Be cautious: DEBUG, and even more TRACE, may have performance impacts.',
        'required' => true,
        'enum' => array (
          'TRACE',
          'DEBUG',
          'INFO',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/system/change_log_level';
    protected const PARAM_MAP = array (
      'level' => 'level',
    );
}
