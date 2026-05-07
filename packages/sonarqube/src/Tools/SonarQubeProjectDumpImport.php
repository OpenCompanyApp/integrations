<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Triggers the import of a project dump. Permission 'Administer' is required. This feature is provided by the Governance plugin..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_dump/import.
 */
class SonarQubeProjectDumpImport extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_dump_import';
    protected const DESCRIPTION = 'Triggers the import of a project dump. Permission \'Administer\' is required. This feature is provided by the Governance plugin.

Official SonarQube Web API endpoint: POST /api/project_dump/import.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'key parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_dump/import';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
