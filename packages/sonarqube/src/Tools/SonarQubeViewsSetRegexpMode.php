<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set the projects selection mode of a portfolio on regular expression. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/set_regexp_mode.
 */
class SonarQubeViewsSetRegexpMode extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_set_regexp_mode';
    protected const DESCRIPTION = 'Set the projects selection mode of a portfolio on regular expression. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/set_regexp_mode.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Selects a branch in all matched projects, instead of using their main branches',
        'required' => false,
      ),
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio or sub-portfolio to update',
        'required' => true,
      ),
      'regexp' => array (
        'type' => 'string',
        'description' => 'A valid regexp with respect to the JDK\'s ``java.util.regex.Pattern`` class',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/set_regexp_mode';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'portfolio' => 'portfolio',
      'regexp' => 'regexp',
    );
}
