<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove the association of a project from a quality gate. Requires one of the following permissions:- 'Administer Quality Gates'; - 'Administer' rights on the project;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/deselect.
 */
class SonarCloudQualitygatesDeselect extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_deselect';
    protected const DESCRIPTION = 'Remove the association of a project from a quality gate. Requires one of the following permissions:- \'Administer Quality Gates\'; - \'Administer\' rights on the project;

Official SonarCloud Web API endpoint: POST /api/qualitygates/deselect.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project id',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/deselect';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
    );
}
