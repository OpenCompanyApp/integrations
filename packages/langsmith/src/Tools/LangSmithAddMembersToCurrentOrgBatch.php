<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Members To Current Org Batch.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/members/batch.
 */
class LangSmithAddMembersToCurrentOrgBatch extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_members_to_current_org_batch';
    protected const DESCRIPTION = 'Add Members To Current Org Batch

Official endpoint: POST /api/v1/orgs/current/members/batch
Batch invite up to 500 users to the current org.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/members/batch';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
