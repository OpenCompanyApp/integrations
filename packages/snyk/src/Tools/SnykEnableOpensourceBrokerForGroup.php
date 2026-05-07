<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Enable opensource broker for group.
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/settings/opensource/broker.
 */
class SnykEnableOpensourceBrokerForGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_enable_opensource_broker_for_group';
    protected const DESCRIPTION = 'Enable opensource broker for group

Official Snyk endpoint: POST /groups/{group_id}/settings/opensource/broker

Enables the opensource broker setting for a group by installing the Snyk App #### Required permissions - `Install Apps (group.app.install)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
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
