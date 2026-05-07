<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Lists audit log entries for a specific repository..
 *
 * Maps to the official Cloudsmith endpoint get /audit-log/{owner}/{repo}/.
 */
class CloudsmithAuditLogRepoList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_audit_log_repo_list';
    protected const DESCRIPTION = 'Lists audit log entries for a specific repository.

Official Cloudsmith endpoint: GET /audit-log/{owner}/{repo}/

Lists audit log entries for a specific repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying events, actors, or timestamps of log records.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/audit-log/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
