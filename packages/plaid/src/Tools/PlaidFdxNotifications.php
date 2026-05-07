<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Webhook receiver for fdx notifications.
 *
 * Maps to the official Plaid endpoint post /fdx/notifications.
 */
class PlaidFdxNotifications extends AbstractPlaidTool
{
    protected const NAME = 'plaid_fdx_notifications';
    protected const DESCRIPTION = 'Webhook receiver for fdx notifications

Official Plaid endpoint: POST /fdx/notifications

A generic webhook receiver endpoint for FDX Event Notifications';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/fdx/notifications';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}