<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete one or several projects. Only the 1'000 first items in project filters are taken into account. Requires 'Administer System' permission. At least one parameter is required among analyzedBefore, projects and q.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/projects/bulk_delete.
 */
class SonarCloudProjectsBulkDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_bulk_delete';
    protected const DESCRIPTION = 'Delete one or several projects. Only the 1\'000 first items in project filters are taken into account. Requires \'Administer System\' permission. At least one parameter is required among analyzedBefore, projects and q

Official SonarCloud Web API endpoint: POST /api/projects/bulk_delete.';
    protected const PARAMETERS = array (
      'analyzed_before' => array (
        'type' => 'string',
        'description' => 'Filter the projects for which last analysis is older than the given date (exclusive). Either a date (server timezone) or datetime can be provided.',
        'required' => false,
      ),
      'on_provisioned_only' => array (
        'type' => 'string',
        'description' => 'Filter the projects that are provisioned',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'The key of the organization',
        'required' => true,
      ),
      'projects' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of project keys',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit to: - component names that contain the supplied string; - component keys that contain the supplied string;',
        'required' => false,
      ),
      'qualifiers' => array (
        'type' => 'string',
        'description' => 'No longer used',
        'required' => false,
        'enum' => array (
          'TRK',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/bulk_delete';
    protected const PARAM_MAP = array (
      'analyzedBefore' => 'analyzed_before',
      'onProvisionedOnly' => 'on_provisioned_only',
      'organization' => 'organization',
      'projects' => 'projects',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
    );
}
