<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Add and remove members in one request. For example, remove user A and add user B. You can add or remove up to 500 users at a time. Required scope organizations:groups:write Rate limiting Level 1 per item. For example, if you want to add 10 users and remove 5, the rate limiting applicable will be 750 credits. This is because each user addition or deletion takes Level 1 rate limiting of 50 credits, so 15 * 50 = 750. Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint PATCH /v2/orgs/{org_id}/groups/{group_id}/members.
 */
class MiroEnterpriseUpdateGroupMembers extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_update_group_members';
    protected const DESCRIPTION = 'Add and remove members in one request. For example, remove user A and add user B. You can add or remove up to 500 users at a time. Required scope organizations:groups:write Rate limiting Level 1 per item. For example, if you want to add 10 users and remove 5, the rate limiting applicable will be 750 credits. This is because each user addition or deletion takes Level 1 rate limiting of 50 credits, so 15 * 50 = 750. Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: PATCH /v2/orgs/{org_id}/groups/{group_id}/members.';
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
    protected const METHOD = 'PATCH';
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
