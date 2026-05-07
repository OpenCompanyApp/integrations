<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert group.
 *
 * Maps to the official Rootly endpoint post /v1/alert_groups.
 */
class RootlyCreateAlertGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert_group';
    protected const DESCRIPTION = 'Creates an alert group

Official Rootly endpoint: POST /v1/alert_groups

Creates a new alert group. **Note**: For enhanced functionality and future compatibility, consider using the advanced alert grouping with `conditions` field instead of the legacy `group_by_alert_title`, `group_by_alert_urgency`, and `attributes` fields.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alert_groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
