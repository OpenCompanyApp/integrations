<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateStackWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/hooks.
 */
class PulumiStacksCreateStackWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_create_stack_webhook';
    protected const DESCRIPTION = 'CreateStackWebhook

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/hooks

Creates a new webhook for the specified stack. The request body must include the webhook name, payload URL, and format. The `format` field accepts: `raw` (default), `slack`, `ms_teams`, or `pulumi_deployments`. The `filters` field accepts a list of event types to subscribe to. See the [webhook event filtering documentation](https://www.pulumi.com/docs/pulumi-cloud/webhooks/#event-filtering) for available filters. The optional `secret` field sets the HMAC key for signature verification. See the [webhook headers documentation](https://www.pulumi.com/docs/pulumi-cloud/webhooks/#headers) for details. Returns 409 if a webhook with the same name already exists. Returns 400 if the organization or stack name in the request body does not match the URL path parameters.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/hooks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
