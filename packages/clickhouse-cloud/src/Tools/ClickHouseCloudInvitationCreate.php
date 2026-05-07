<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create an invitation.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/invitations.
 */
class ClickHouseCloudInvitationCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_invitation_create';
    protected const DESCRIPTION = 'Create an invitation

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/invitations

Creates organization invitation.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization to invite a user to.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/organizations/{organizationId}/invitations';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
