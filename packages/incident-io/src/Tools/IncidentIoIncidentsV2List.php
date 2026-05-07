<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incidents V2.
 *
 * Maps to the official incident.io endpoint get /v2/incidents.
 */
class IncidentIoIncidentsV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v2_list';
    protected const DESCRIPTION = 'List Incidents V2

Official incident.io endpoint: GET /v2/incidents

List all incidents for an organisation.

This endpoint supports a number of filters, which can help find incidents matching certain
criteria.

Filters are provided as query parameters, but due to the dynamic nature of what you can
query by (different accounts have different custom fields, statuses, etc) they are more
complex than most.

The maximum page size that can be requested is 250.

To help, here are some exemplar curl requests with a human description of what they search
for.

Note that:
- Filters may be combined using the filter_mode parameter: \'all\' (default) requires all filters
to match (AND logic), while \'any\' requires at least one filter to match (OR logic).
- IDs are normally in UUID format, but have been replaced with shorter strings to improve
readability.
- All query parameters must be URI encoded.

### By status

With status of id=ABC, find all incidents that are set to that status:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'status[one_of]=ABC\'

Or all incidents that are not set to status with id=ABC:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'status[not_in]=ABC\'

### By created_at or updated_at

Find all incidents that follow specified date parameters for created_at and updated_at fields.
Possible values are "gte" (greater than or equal to), "lte" (less than or equal to), and
"date_range" (between two dates). The following example finds all incidents created before
or on 2021-01-02T00:00:00Z:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'created_at[lte]=2021-01-02\'

To find incidents created within a specific date range, use the date_range option with
tilde-separated dates:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'created_at[date_range]=2024-12-02~2024-12-08\'

### By status category

Find all incidents that are in a status category. Possible values are "triage",
"declined", "merged", "canceled", "live", "learning" and "closed":

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'status_category[one_of]=live\'

Or all incidents that are not in a status category:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'status_category[not_in]=live\'


### By severity

With severity of id=ABC, find all incidents that are set to that severity:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'severity[one_of]=ABC\'

Or all incidents where severity rank is greater-than-or-equal-to the rank of severity
id=ABC:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'severity[gte]=ABC\'

Or all incidents where severity rank is less-than-or-equal-to the rank of severity id=ABC:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'severity[lte]=ABC\'

### By incident type

With incident type of id=ABC, find all incidents that are of that type:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'incident_type[one_of]=ABC\'

Or all incidents not of that type:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'incident_type[not_in]=ABC\'

### By incident mode

By default, we return standard and retrospective incidents. This means that test and
tutorial incidents are filtered out. To override this behaviour, you can use the
mode filter to specify which modes you want to get.

To find incidents of all modes:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'mode[one_of]=standard&mode[one_of]=retrospective&mode[one_of]=test&mode[one_of]=tutorial\'

To find just test incidents:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'mode[one_of]=test\'


### By incident role

Roles and custom fields have another nested layer in the query parameter, to account for
operations against any of the roles or custom fields created in the account.

With incident role id=ABC, find all incidents where that role is unset:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'incident_role[ABC][is_set]=true\'

Or where the role has been set:

		curl --get \'https://api.incident.io/v2/incidents\' \\
			--data \'incident_role[ABC][is_set]=false\'

### By option custom fields

With an option custom field id=ABC, all incidents that have field ABC set to the custom
field option of id=XYZ:

		curl \\
			--get \'https://api.incident.io/v2/incidents\' \\
			--data \'custom_field[ABC][one_of]=XYZ\'

Or all incidents that do not have custom field id=ABC set to option id=XYZ:

		curl \\
			--get \'https://api.incident.io/v2/incidents\' \\
			--data \'custom_field[ABC][not_in]=XYZ\'

### Sorting

By default, results are ordered by their creation date. You can use the sort_by parameter
to reverse this order:

		curl \\
			--get \'https://api.incident.io/v2/incidents\' \\
			--data \'sort_by=created_at_oldest_first\'';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An incident\'s ID. This endpoint will return a list of incidents after this ID in relation to the API response order.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'description' => 'What order to return results in.',
    'enum' =>
    array (
      0 => 'created_at_newest_first',
      1 => 'created_at_oldest_first',
    ),
  ),
  'filter_mode' =>
  array (
    'type' => 'string',
    'description' => 'How to combine the filters: \'all\' combines them with AND logic (all must match), \'any\' combines them with OR logic (any can match). Defaults to \'all\'.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'any',
    ),
  ),
  'status' =>
  array (
    'type' => 'object',
    'description' => 'Filter on incident status. The accepted operators are \'one_of\', or \'not_in\'.',
  ),
  'status_category' =>
  array (
    'type' => 'object',
    'description' => 'Filter on the category of the incidents status. The accepted operators are \'one_of\', or \'not_in\'.',
  ),
  'created_at' =>
  array (
    'type' => 'object',
    'description' => 'Filter on incident created at timestamp. The accepted operators are \'gte\', \'lte\' and \'date_range\'.',
  ),
  'updated_at' =>
  array (
    'type' => 'object',
    'description' => 'Filter on incident updated at timestamp. The accepted operators are \'gte\', \'lte\' and \'date_range\'.',
  ),
  'severity' =>
  array (
    'type' => 'object',
    'description' => 'Filter on incident severity. The accepted operators are \'one_of\', \'not_in\', \'gte\', \'lte\'.',
  ),
  'incident_type' =>
  array (
    'type' => 'object',
    'description' => 'Filter on incident type. The accepted operators are \'one_of, or \'not_in\'.',
  ),
  'incident_role' =>
  array (
    'type' => 'object',
    'description' => 'Filter on an incident role. Role ID should be sent, along with backlink attribute ID (if needed) followed by the operator and values. The accepted operators are \'one_of\', \'is_blank\'.',
  ),
  'custom_field' =>
  array (
    'type' => 'object',
    'description' => 'Filter on an incident custom field. Custom field ID should be sent, followed by the operator and values. Accepted operator will depend on the custom field type.',
  ),
  'mode' =>
  array (
    'type' => 'object',
    'description' => 'Filter on incident mode. The accepted operator is \'one_of\'.  If this is not provided, this value defaults to `{"one_of": ["standard", "retrospective"] }`, meaning that test and tutorial incidents are not included.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'sort_by' => 'sort_by',
  'filter_mode' => 'filter_mode',
  'status' => 'status',
  'status_category' => 'status_category',
  'created_at' => 'created_at',
  'updated_at' => 'updated_at',
  'severity' => 'severity',
  'incident_type' => 'incident_type',
  'incident_role' => 'incident_role',
  'custom_field' => 'custom_field',
  'mode' => 'mode',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
