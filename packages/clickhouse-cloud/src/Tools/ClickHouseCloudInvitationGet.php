<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get invitation details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/invitations/{invitationId}.
 */
class ClickHouseCloudInvitationGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_invitation_get';
    protected const DESCRIPTION = 'Get invitation details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/invitations/{invitationId}

Returns details for a single organization invitation.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'invitation_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/invitations/{invitationId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'invitationId' => 'invitation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
