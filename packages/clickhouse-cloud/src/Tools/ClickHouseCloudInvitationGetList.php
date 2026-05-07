<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List all invitations.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/invitations.
 */
class ClickHouseCloudInvitationGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_invitation_get_list';
    protected const DESCRIPTION = 'List all invitations

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/invitations

Returns list of all organization invitations.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
