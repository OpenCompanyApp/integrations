<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Apply a permission template to several components. Managed projects will be ignored. The template id or name must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/bulk_apply_template.
 */
class SonarQubePermissionsBulkApplyTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_bulk_apply_template';
    protected const DESCRIPTION = 'Apply a permission template to several components. Managed projects will be ignored. The template id or name must be provided. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/bulk_apply_template.';
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
        'description' => 'Comma-separated list of component qualifiers. Filter the results with the specified qualifiers. Possible values are:- APP - Applications; - TRK - Projects; - VW - Portfolios;',
        'required' => false,
        'enum' => array (
          'APP',
          'TRK',
          'VW',
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
      'projects' => 'projects',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
