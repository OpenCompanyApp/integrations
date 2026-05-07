<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete organization invitation.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/invitations/{invitationId}.
 */
class ClickHouseCloudInvitationDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_invitation_delete';
    protected const DESCRIPTION = 'Delete organization invitation

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/invitations/{invitationId}

Deletes a single organization invitation.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that has the invitation.',
    'required' => true,
  ),
  'invitation_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
