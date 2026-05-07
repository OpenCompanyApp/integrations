<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Escalations V2.
 *
 * Maps to the official incident.io endpoint get /v2/escalations.
 */
class IncidentIoEscalationsV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_list';
    protected const DESCRIPTION = 'List Escalations V2

Official incident.io endpoint: GET /v2/escalations

List all escalations for your account.

This endpoint supports a number of filters, which can help find escalations matching certain
criteria.

Note that:
- Filters may be used together, and the result will be escalations that match all filters.
- All query parameters must be URI encoded.

To use this API, you will need an API key with the "View data" or "Create and manage on-call resources" permission.

### By escalation_path

Find all escalations that escalated to escalation path with id=ABC:

		curl --get \'https://api.incident.io/v2/escalations\' \\
			--data \'escalation_path[one_of]=ABC\'

### By status

Find all escalations with a current status of "triggered":

		curl --get \'https://api.incident.io/v2/escalations\' \\
			--data \'status[one_of]=triggered\'

Possible values are "pending", "triggered", "acked", "resolved", "expired" and "cancelled".
Escalations are in "pending" when they are in a grace period when the related alert has
been grouped in an incident.

### By alert

Find all escalations that were created by alert with id=ABC:

		curl --get \'https://api.incident.io/v2/escalations\' \\
			--data \'alert[one_of]=ABC\'

### By created_at and updated_at
Find all escalations that follow specified date parameters for created_at and updated_at fields.
Possible values are "gte" (greater than or equal to), "lte" (less than or equal to), and
"date_range" (between two dates).
For example, to find all escalations updated after 2025-01-01:

		curl --get \'https://api.incident.io/v2/escalations\' \\
			--data \'updated_at[gte]=2025-01-01\'

To find all escalations created between 2025-01-01 and 2025-01-31:

		curl --get \'https://api.incident.io/v2/escalations\' \\
            --data \'created_at[date_range]=2025-01-01~2025-01-31\'';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of escalations to return per page',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An escalation\'s ID. This endpoint will return a list of escalations after this ID in relation to the API response order.',
  ),
  'escalation_path' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the escalation path for which the escalation was triggered. Accepted operators are \'one_of\' and \'not_in\'.',
  ),
  'status' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the status of the escalation. Accepted operators are \'one_of\' and \'not_in\'.',
  ),
  'alert' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the alert that created an escalation. Accepted operators are \'one_of\' and \'not_in\'.',
  ),
  'created_at' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the created_at timestamp of the escalation. Accepted operators are \'gte\', \'lte\' and \'date_range\'.',
  ),
  'updated_at' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the updated_at timestamp of the escalation. Accepted operators are \'gte\', \'lte\' and \'date_range\'.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the idempotency key of the escalation. This is the key set when creating escalations via the API, and is distinct from alert deduplication keys. Accepted operators are \'is\' for exact matches and \'starts_with\' for prefix matching.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/escalations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'escalation_path' => 'escalation_path',
  'status' => 'status',
  'alert' => 'alert',
  'created_at' => 'created_at',
  'updated_at' => 'updated_at',
  'idempotency_key' => 'idempotency_key',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
