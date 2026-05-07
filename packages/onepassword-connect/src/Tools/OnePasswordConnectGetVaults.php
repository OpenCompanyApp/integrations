<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get all Vaults.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults.
 */
class OnePasswordConnectGetVaults extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_vaults';
    protected const DESCRIPTION = 'Get all Vaults

Official 1Password Connect endpoint: GET /vaults.';
    protected const PARAMETERS = array (
      'filter' => array (
        'type' => 'string',
        'description' => 'Filter the Vault collection based on Vault name using SCIM eq filter',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/vaults';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'filter' => 'filter',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
