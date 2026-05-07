<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateOrganizationWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/hooks.
 */
class PulumiOrganizationsCreateOrganizationWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_organization_webhook';
    protected const DESCRIPTION = 'CreateOrganizationWebhook

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/hooks

Creates a new webhook for an organization to notify external services when events occur. Webhooks can be configured to fire on stack events (created, deleted, update succeeded/failed), deployment events (queued, started, succeeded, failed), drift detection events, and policy violation events (mandatory, advisory). The `format` field accepts: `raw` (default), `slack`, `ms_teams`, or `pulumi_deployments`. The `filters` field accepts a list of event types to subscribe to. See the [webhook event filtering documentation](https://www.pulumi.com/docs/pulumi-cloud/webhooks/#event-filtering) for available filters. The optional `secret` field sets the HMAC key for signature verification via the `Pulumi-Webhook-Signature` header. See the [webhook headers documentation](https://www.pulumi.com/docs/pulumi-cloud/webhooks/#headers) for details.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/hooks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
