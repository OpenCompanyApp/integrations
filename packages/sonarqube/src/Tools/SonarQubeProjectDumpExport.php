<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Triggers project dump so that the project can be imported to another SonarQube server (see api/project_dump/import, available in Enterprise Edition). Requires the 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_dump/export.
 */
class SonarQubeProjectDumpExport extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_dump_export';
    protected const DESCRIPTION = 'Triggers project dump so that the project can be imported to another SonarQube server (see api/project_dump/import, available in Enterprise Edition). Requires the \'Administer\' permission.

Official SonarQube Web API endpoint: POST /api/project_dump/export.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'key parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_dump/export';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
