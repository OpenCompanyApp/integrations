<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Pending Organization Invites.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/pending.
 */
class LangSmithListPendingOrganizationInvites extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_pending_organization_invites';
    protected const DESCRIPTION = 'List Pending Organization Invites

Official endpoint: GET /api/v1/orgs/pending
Get all pending orgs visible to this auth';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/pending';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
