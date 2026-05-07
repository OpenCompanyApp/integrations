<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Reindex issues for a project. Require 'Administer System' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/reindex.
 */
class SonarQubeIssuesReindex extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_reindex';
    protected const DESCRIPTION = 'Reindex issues for a project. Require \'Administer System\' permission.

Official SonarQube Web API endpoint: POST /api/issues/reindex.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/reindex';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
