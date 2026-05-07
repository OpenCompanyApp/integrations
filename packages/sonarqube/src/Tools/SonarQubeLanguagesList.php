<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List supported programming languages.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/languages/list.
 */
class SonarQubeLanguagesList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_languages_list';
    protected const DESCRIPTION = 'List supported programming languages

Official SonarQube Web API endpoint: GET /api/languages/list.';
    protected const PARAMETERS = array (
      'ps' => array (
        'type' => 'string',
        'description' => 'The size of the list to return, 0 for all languages',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'A pattern to match language keys/names against',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/languages/list';
    protected const PARAM_MAP = array (
      'ps' => 'ps',
      'q' => 'q',
    );
}
