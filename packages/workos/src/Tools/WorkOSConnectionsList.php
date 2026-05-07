<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Connections.
 *
 * Maps to the official WorkOS endpoint get /connections.
 */
class WorkOSConnectionsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_connections_list';
    protected const DESCRIPTION = 'List Connections

Official WorkOS endpoint: GET /connections

Get a list of all of your existing connections matching the criteria specified.';
    protected const PARAMETERS = array (
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
  'connection_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `connection_type` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'ADFSSAML',
      1 => 'AdpOidc',
      2 => 'AppleOAuth',
      3 => 'Auth0SAML',
      4 => 'AzureSAML',
      5 => 'BitbucketOAuth',
      6 => 'CasSAML',
      7 => 'CloudflareSAML',
      8 => 'ClassLinkSAML',
      9 => 'CleverOIDC',
      10 => 'CyberArkSAML',
      11 => 'DiscordOAuth',
      12 => 'DuoSAML',
      13 => 'EntraIdOIDC',
      14 => 'GenericOIDC',
      15 => 'GenericSAML',
      16 => 'GithubOAuth',
      17 => 'GitLabOAuth',
      18 => 'GoogleOAuth',
      19 => 'GoogleOIDC',
      20 => 'GoogleSAML',
      21 => 'IntuitOAuth',
      22 => 'JumpCloudSAML',
      23 => 'KeycloakSAML',
      24 => 'LastPassSAML',
      25 => 'LinkedInOAuth',
      26 => 'LoginGovOidc',
      27 => 'MagicLink',
      28 => 'MicrosoftOAuth',
      29 => 'MiniOrangeSAML',
      30 => 'NetIqSAML',
      31 => 'OktaOIDC',
      32 => 'OktaSAML',
      33 => 'OneLoginSAML',
      34 => 'OracleSAML',
      35 => 'PingFederateSAML',
      36 => 'PingOneSAML',
      37 => 'RipplingSAML',
      38 => 'SalesforceSAML',
      39 => 'ShibbolethGenericSAML',
      40 => 'ShibbolethSAML',
      41 => 'SimpleSamlPhpSAML',
      42 => 'SalesforceOAuth',
      43 => 'SlackOAuth',
      44 => 'VercelMarketplaceOAuth',
      45 => 'VercelOAuth',
      46 => 'VMwareSAML',
      47 => 'XeroOAuth',
    ),
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `domain` from the official WorkOS API operation.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `search` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'connection_type' => 'connection_type',
  'domain' => 'domain',
  'organization_id' => 'organization_id',
  'search' => 'search',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
