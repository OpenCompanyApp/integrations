<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves board classification settings for an existing team. Required scope organizations:teams:read Rate limiting Level 2 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/teams/{team_id}/data-classification-settings.
 */
class MiroEnterpriseDataclassificationTeamSettingsGet extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_dataclassification_team_settings_get';
    protected const DESCRIPTION = 'Retrieves board classification settings for an existing team. Required scope organizations:teams:read Rate limiting Level 2 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/teams/{team_id}/data-classification-settings.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'id of the organization',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'id of the team',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/data-classification-settings';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
