<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an alert group.
 *
 * Maps to the official Rootly endpoint patch /v1/alert_groups/{id}.
 */
class RootlyUpdateAlertGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alert_group';
    protected const DESCRIPTION = 'Update an alert group

Official Rootly endpoint: PATCH /v1/alert_groups/{id}

Update a specific alert group by id. **Note**: For enhanced functionality and future compatibility, consider using the advanced alert grouping with `conditions` field instead of the legacy `group_by_alert_title`, `group_by_alert_urgency`, and `attributes` fields.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/alert_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
