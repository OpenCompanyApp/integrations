<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Seed a connected application for a Permissions Manager sandbox item.
 *
 * Maps to the official Plaid endpoint post /sandbox/item/application/seed.
 */
class PlaidSandboxItemApplicationSeed extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_item_application_seed';
    protected const DESCRIPTION = 'Seed a connected application for a Permissions Manager sandbox item

Official Plaid endpoint: POST /sandbox/item/application/seed

`/sandbox/item/application/seed` creates a test connected application on an existing Permissions Manager Item\'s login. The seeded application will appear in subsequent calls to `/item/application/list`. The `access_token` must belong to a Permissions Manager Item created via `/item/import` in Sandbox. The `application_id` identifies the application to seed as a connected app. To disconnect a seeded application, use `/item/application/unlink`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/item/application/seed';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}