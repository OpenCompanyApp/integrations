<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete opensource broker setting for group.
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/settings/opensource/broker.
 */
class SnykDeleteOpensourceBrokerSettingForGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_opensource_broker_setting_for_group';
    protected const DESCRIPTION = 'Delete opensource broker setting for group

Official Snyk endpoint: DELETE /groups/{group_id}/settings/opensource/broker

Deletes the opensource broker setting for the group by uninstalling the Snyk App #### Required permissions - `Install Apps (group.app.install)`';
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
    protected const METHOD = 'delete';
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
