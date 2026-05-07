<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Projects are essentially folders of boards with the option to manage user access for a smaller group of people within a team. Projects are here to help you organize your boards and make them easier to find and share. In other words, a project is a group of boards that you can share with your teammates all at once. For more information, see our Help Center page on Projects. This API creates a new project in an existing team of an organization.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/teams/{team_id}/projects.
 */
class MiroEnterpriseCreateProject extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_create_project';
    protected const DESCRIPTION = 'Projects are essentially folders of boards with the option to manage user access for a smaller group of people within a team. Projects are here to help you organize your boards and make them easier to find and share. In other words, a project is a group of boards that you can share with your teammates all at once. For more information, see our Help Center page on Projects. This API creates a new project in an existing team of an organization.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: POST /v2/orgs/{org_id}/teams/{team_id}/projects.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization within which you you want to create a project.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of the team within which you you want to create a project.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/projects';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
