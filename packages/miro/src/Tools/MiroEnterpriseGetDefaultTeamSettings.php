<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves default team settings of an existing organization. Required scope organizations:teams:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/default_teams_settings.
 */
class MiroEnterpriseGetDefaultTeamSettings extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_default_team_settings';
    protected const DESCRIPTION = 'Retrieves default team settings of an existing organization. Required scope organizations:teams:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/default_teams_settings.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The id of an Organization.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/default_teams_settings';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
