<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Export all findings (issues and hotspots) of a specific project branch. Requires 'Administer System' permission. Keep in mind that this endpoint will return all findings, issues and hotspots (no filter), which can take time and use a lot of resources on the SonarQube server side and put pressure on the database until completion. This endpoint can be used to feed third party systems. Either the branch key or the pull request key should be specified, and not both at the same time..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/projects/export_findings.
 */
class SonarQubeProjectsExportFindings extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_export_findings';
    protected const DESCRIPTION = 'Export all findings (issues and hotspots) of a specific project branch. Requires \'Administer System\' permission. Keep in mind that this endpoint will return all findings, issues and hotspots (no filter), which can take time and use a lot of resources on the SonarQube server side and put pressure on the database until completion. This endpoint can be used to feed third party systems. Either the branch key or the pull request key should be specified, and not both at the same time.

Official SonarQube Web API endpoint: GET /api/projects/export_findings.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. When not specified, if no Pull Request key is defined either, it will default to the main branch',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull Request key. When not specified, the branch data will be returned instead',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/projects/export_findings';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
      'pullRequest' => 'pull_request',
    );
}
