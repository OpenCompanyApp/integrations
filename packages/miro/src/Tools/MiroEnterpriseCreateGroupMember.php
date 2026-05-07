<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a member to a user group in an organization. Required scope organizations:groups:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/groups/{group_id}/members.
 */
class MiroEnterpriseCreateGroupMember extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_create_group_member';
    protected const DESCRIPTION = 'Adds a member to a user group in an organization. Required scope organizations:groups:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: POST /v2/orgs/{org_id}/groups/{group_id}/members.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of an organization.',
        'required' => true,
      ),
      'group_id' => array (
        'type' => 'string',
        'description' => 'The ID of a user group.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/groups/{group_id}/members';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
