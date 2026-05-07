<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Apply a permission template to several projects. The template id or name must be provided. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/bulk_apply_template.
 */
class SonarCloudPermissionsBulkApplyTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_bulk_apply_template';
    protected const DESCRIPTION = 'Apply a permission template to several projects. The template id or name must be provided. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/bulk_apply_template.';
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
        'description' => 'Key of organization, used when group name is set',
        'required' => false,
      ),
      'projects' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of project keys',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - project names that contain the supplied string; - project keys that are exactly the same as the supplied string;',
        'required' => false,
      ),
      'qualifiers' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of component qualifiers. Filter the results with the specified qualifiers. Possible values are:- TRK - Projects;',
        'required' => false,
        'enum' => array (
          'TRK',
        ),
      ),
      'template_id' => array (
        'type' => 'string',
        'description' => 'Template id',
        'required' => false,
      ),
      'template_name' => array (
        'type' => 'string',
        'description' => 'Template name',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/permissions/bulk_apply_template';
    protected const PARAM_MAP = array (
      'analyzedBefore' => 'analyzed_before',
      'onProvisionedOnly' => 'on_provisioned_only',
      'organization' => 'organization',
      'projects' => 'projects',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
