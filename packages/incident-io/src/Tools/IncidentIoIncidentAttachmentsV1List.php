<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Attachments V1.
 *
 * Maps to the official incident.io endpoint get /v1/incident_attachments.
 */
class IncidentIoIncidentAttachmentsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_attachments_v1_list';
    protected const DESCRIPTION = 'List Incident Attachments V1

Official incident.io endpoint: GET /v1/incident_attachments

List all incident attachments for a given external resource or incident. You must provide either a specific incident ID or a specific external resource type and external ID.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Incident that this attachment is against',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the resource in the external system',
  ),
  'resource_type' =>
  array (
    'type' => 'string',
    'description' => 'E.g. PagerDuty: the external system that holds the resource',
    'enum' =>
    array (
      0 => 'pager_duty_incident',
      1 => 'opsgenie_alert',
      2 => 'datadog_monitor_alert',
      3 => 'github_pull_request',
      4 => 'gitlab_merge_request',
      5 => 'sentry_issue',
      6 => 'jira_issue',
      7 => 'jsm_alert',
      8 => 'atlassian_statuspage_incident',
      9 => 'zendesk_ticket',
      10 => 'google_calendar_event',
      11 => 'outlook_calendar_event',
      12 => 'slack_file',
      13 => 'salesforce_case',
      14 => 'scrubbed',
      15 => 'statuspage_incident',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_attachments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'incident_id' => 'incident_id',
  'external_id' => 'external_id',
  'resource_type' => 'resource_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
