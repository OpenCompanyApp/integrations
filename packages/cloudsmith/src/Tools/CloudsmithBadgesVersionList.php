<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get latest package version for a package or package group..
 *
 * Maps to the official Cloudsmith endpoint get /badges/version/{owner}/{repo}/{package_format}/{package_name}/{package_version}/{package_identifiers}/.
 */
class CloudsmithBadgesVersionList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_badges_version_list';
    protected const DESCRIPTION = 'Get latest package version for a package or package group.

Official Cloudsmith endpoint: GET /badges/version/{owner}/{repo}/{package_format}/{package_name}/{package_version}/{package_identifiers}/

Get latest package version for a package or package group.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'package_format' => array (
  'type' => 'string',
  'description' => 'package_format parameter.',
  'required' => true,
),
  'package_name' => array (
  'type' => 'string',
  'description' => 'package_name parameter.',
  'required' => true,
),
  'package_version' => array (
  'type' => 'string',
  'description' => 'package_version parameter.',
  'required' => true,
),
  'package_identifiers' => array (
  'type' => 'string',
  'description' => 'package_identifiers parameter.',
  'required' => true,
),
  'badge_token' => array (
  'type' => 'string',
  'description' => 'Badge token to authenticate for private packages',
),
  'cache_seconds' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge cacheSeconds value.',
),
  'color' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge color value.',
),
  'label' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge label value.',
),
  'label_color' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge labelColor value.',
),
  'logo_color' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge logoColor value.',
),
  'logo_width' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge logoWidth value.',
),
  'render' => array (
  'type' => 'string',
  'description' => 'If true, badge will be rendered',
),
  'shields' => array (
  'type' => 'string',
  'description' => 'If true, a shields response will be generated',
),
  'show_latest' => array (
  'type' => 'string',
  'description' => 'If true, for latest version badges a \'(latest)\' suffix is added',
),
  'style' => array (
  'type' => 'string',
  'description' => 'Override the shields.io badge style value.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/badges/version/{owner}/{repo}/{package_format}/{package_name}/{package_version}/{package_identifiers}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'package_format' => 'package_format',
  'package_name' => 'package_name',
  'package_version' => 'package_version',
  'package_identifiers' => 'package_identifiers',
);
    protected const QUERY_PARAMS = array (
  'badge_token' => 'badge_token',
  'cacheSeconds' => 'cache_seconds',
  'color' => 'color',
  'label' => 'label',
  'labelColor' => 'label_color',
  'logoColor' => 'logo_color',
  'logoWidth' => 'logo_width',
  'render' => 'render',
  'shields' => 'shields',
  'show_latest' => 'show_latest',
  'style' => 'style',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
