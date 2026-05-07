<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RedeliverOrganizationWebhookEvent.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/hooks/{hookName}/deliveries/{event}/redeliver.
 */
class PulumiOrganizationsRedeliverOrganizationWebhookEvent extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_redeliver_organization_webhook_event';
    protected const DESCRIPTION = 'RedeliverOrganizationWebhookEvent

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/hooks/{hookName}/deliveries/{event}/redeliver

Triggers the Pulumi Service to redeliver a specific event to a webhook. For example, to resend an event that the hook failed to process the first time.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name identifier',
  ),
  'event' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `event` from the official Pulumi Cloud API operation. The event identifier to redeliver',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/hooks/{hookName}/deliveries/{event}/redeliver';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'hookName' => 'hook_name',
  'event' => 'event',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
