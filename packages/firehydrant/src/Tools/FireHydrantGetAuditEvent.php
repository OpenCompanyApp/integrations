<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a single audit event.
 *
 * Maps to the official FireHydrant endpoint get /v1/audit_events/{id}.
 */
class FireHydrantGetAuditEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_audit_event';
    protected const DESCRIPTION = 'Get a single audit event

Official FireHydrant endpoint: GET /v1/audit_events/{id}

Get a single audit event';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audit_events/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
