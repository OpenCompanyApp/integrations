<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set device tags.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/tags.
 */
class TailscaleSetDeviceTags extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_device_tags';
    protected const DESCRIPTION = 'Set device tags

Official Tailscale endpoint: POST /device/{deviceId}/tags

Tags let you assign an identity to a device that is separate from human users, and use that identity as part of an ACL to restrict access.
Tags are similar to role accounts, but more flexible.

Tags are created in the tailnet policy file by defining the tag and an owner of the tag.
Once a device is tagged, the tag is the owner of that device.
A single node can have multiple tags assigned.

Consult the policy file for your tailnet in the [admin console](https://login.tailscale.com/admin/acls) for the list of tags that have been created for your tailnet.
Learn more about [tags](https://tailscale.com/kb/1068/).

OAuth Scope: `devices:core`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device/{deviceId}/tags';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
