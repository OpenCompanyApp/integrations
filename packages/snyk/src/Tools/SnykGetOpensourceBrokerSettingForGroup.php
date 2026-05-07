<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get opensource broker setting for group.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/settings/opensource/broker.
 */
class SnykGetOpensourceBrokerSettingForGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_opensource_broker_setting_for_group';
    protected const DESCRIPTION = 'Get opensource broker setting for group

Official Snyk endpoint: GET /groups/{group_id}/settings/opensource/broker

Returns whether the opensource broker setting is enabled for the group #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/settings/opensource/broker';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
