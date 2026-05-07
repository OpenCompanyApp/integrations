<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get the quality gate of a project. Requires one of the following permissions:- 'Administer' rights on the specified project; - 'Browse' on the specified project;.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualitygates/get_by_project.
 */
class SonarCloudQualitygatesGetByProject extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_get_by_project';
    protected const DESCRIPTION = 'Get the quality gate of a project. Requires one of the following permissions:- \'Administer\' rights on the specified project; - \'Browse\' on the specified project;

Official SonarCloud Web API endpoint: GET /api/qualitygates/get_by_project.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/get_by_project';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'project' => 'project',
    );
}
