<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Shares a project with user groups with a specified role. Updates the role if already shared. Required scope organizations:groups:read projects:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/projects/{project_id}/groups.
 */
class MiroEnterpriseProjectCreateGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_project_create_group';
    protected const DESCRIPTION = 'Shares a project with user groups with a specified role. Updates the role if already shared. Required scope organizations:groups:read projects:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: POST /v2/orgs/{org_id}/projects/{project_id}/groups.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of an organization.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'The ID of the project.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/projects/{project_id}/groups';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'project_id' => 'project_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
