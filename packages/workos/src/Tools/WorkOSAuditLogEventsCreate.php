<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create Event.
 *
 * Maps to the official WorkOS endpoint post /audit_logs/events.
 */
class WorkOSAuditLogEventsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_log_events_create';
    protected const DESCRIPTION = 'Create Event

Official WorkOS endpoint: POST /audit_logs/events

Create an Audit Log Event. This API supports idempotency which guarantees that performing the same operation multiple times will have the same result as if the operation were performed only once. This is handy in situations where you may need to retry a request due to a failure or prevent accidental duplicate requests from creating more than one resource. To achieve idempotency, you can add `Idempotency-Key` request header to a Create Event request with a unique string as the value. Each subsequent request matching this unique string will return the same response. We suggest using [v4 UUIDs](https://en.wikipedia.org/wiki/Universally_unique_identifier) for idempotency keys to avoid collisi...';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `idempotency-key` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/audit_logs/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'idempotency-key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
