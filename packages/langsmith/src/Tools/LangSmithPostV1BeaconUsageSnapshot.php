<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Submit a self-hosted usage snapshot.
 *
 * Maps to the official LangSmith endpoint POST /v1/beacon/usage-snapshot.
 */
class LangSmithPostV1BeaconUsageSnapshot extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_beacon_usage_snapshot';
    protected const DESCRIPTION = 'Submit a self-hosted usage snapshot

Official endpoint: POST /v1/beacon/usage-snapshot
Records aggregate entity counts (workspaces, projects, datasets, active users, etc.) from a self-hosted deployment. Called daily by installs where PHONE_HOME_ENABLED and PHONE_HOME_USAGE_REPORTING_ENABLED are set. Authenticates via license key.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/beacon/usage-snapshot';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
