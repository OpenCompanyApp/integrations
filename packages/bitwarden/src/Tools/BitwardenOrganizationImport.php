<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Import members and groups.
 *
 * Maps to the official Bitwarden Public API endpoint post /public/organization/import.
 */
class BitwardenOrganizationImport extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_organization_import';
    protected const DESCRIPTION = 'Import members and groups.

Official Bitwarden Public API endpoint: POST /public/organization/import

Import members and groups from an external system.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/public/organization/import';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
