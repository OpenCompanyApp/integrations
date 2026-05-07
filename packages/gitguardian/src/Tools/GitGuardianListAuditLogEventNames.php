<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List audit log event names.
 *
 * Maps to the official GitGuardian endpoint GET /v1/audit_logs/event_names.
 */
class GitGuardianListAuditLogEventNames extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_audit_log_event_names';
    protected const DESCRIPTION = 'List all the existing event names for audit logs. Use this endpoint to discover which event types are available for filtering when querying audit logs.

Official GitGuardian endpoint: GET /v1/audit_logs/event_names.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/audit_logs/event_names';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
