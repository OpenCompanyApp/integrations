<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive an incident role.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incident_roles/{incident_role_id}.
 */
class FireHydrantDeleteIncidentRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_role';
    protected const DESCRIPTION = 'Archive an incident role

Official FireHydrant endpoint: DELETE /v1/incident_roles/{incident_role_id}

Archives an incident role which will hide it from lists and metrics';
    protected const PARAMETERS = array (
  'incident_role_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_role_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_roles/{incident_role_id}';
    protected const PATH_PARAMS = array (
  'incident_role_id' => 'incident_role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
