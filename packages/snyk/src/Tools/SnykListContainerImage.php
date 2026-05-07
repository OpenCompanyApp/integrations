<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List instances of container image.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/container_images.
 */
class SnykListContainerImage extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_container_image';
    protected const DESCRIPTION = 'List instances of container image

Official Snyk endpoint: GET /orgs/{org_id}/container_images

List instances of container image #### Required permissions - `View container images (org.container_image.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'image_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `image_ids` from the official Snyk API operation. A comma-separated list of Image IDs',
  ),
  'platform' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `platform` from the official Snyk API operation. The image Operating System and processor architecture',
    'enum' =>
    array (
      0 => 'aix/ppc64',
      1 => 'android/386',
      2 => 'android/amd64',
      3 => 'android/arm',
      4 => 'android/arm/v5',
      5 => 'android/arm/v6',
      6 => 'android/arm/v7',
      7 => 'android/arm64',
      8 => 'android/arm64/v8',
      9 => 'darwin/amd64',
      10 => 'darwin/arm',
      11 => 'darwin/arm/v5',
      12 => 'darwin/arm/v6',
      13 => 'darwin/arm/v7',
      14 => 'darwin/arm64',
      15 => 'darwin/arm64/v8',
      16 => 'dragonfly/amd64',
      17 => 'freebsd/386',
      18 => 'freebsd/amd64',
      19 => 'freebsd/arm',
      20 => 'freebsd/arm/v5',
      21 => 'freebsd/arm/v6',
      22 => 'freebsd/arm/v7',
      23 => 'illumos/amd64',
      24 => 'ios/arm64',
      25 => 'ios/arm64/v8',
      26 => 'js/wasm',
      27 => 'linux/386',
      28 => 'linux/amd64',
      29 => 'linux/arm',
      30 => 'linux/arm/v5',
      31 => 'linux/arm/v6',
      32 => 'linux/arm/v7',
      33 => 'linux/arm64',
      34 => 'linux/arm64/v8',
      35 => 'linux/loong64',
      36 => 'linux/mips',
      37 => 'linux/mipsle',
      38 => 'linux/mips64',
      39 => 'linux/mips64le',
      40 => 'linux/ppc64',
      41 => 'linux/ppc64le',
      42 => 'linux/riscv64',
      43 => 'linux/s390x',
      44 => 'linux/x86_64',
      45 => 'netbsd/386',
      46 => 'netbsd/amd64',
      47 => 'netbsd/arm',
      48 => 'netbsd/arm/v5',
      49 => 'netbsd/arm/v6',
      50 => 'netbsd/arm/v7',
      51 => 'openbsd/386',
      52 => 'openbsd/amd64',
      53 => 'openbsd/arm',
      54 => 'openbsd/arm/v5',
      55 => 'openbsd/arm/v6',
      56 => 'openbsd/arm/v7',
      57 => 'openbsd/arm64',
      58 => 'openbsd/arm64/v8',
      59 => 'plan9/386',
      60 => 'plan9/amd64',
      61 => 'plan9/arm',
      62 => 'plan9/arm/v5',
      63 => 'plan9/arm/v6',
      64 => 'plan9/arm/v7',
      65 => 'solaris/amd64',
      66 => 'windows/386',
      67 => 'windows/amd64',
      68 => 'windows/arm',
      69 => 'windows/arm/v5',
      70 => 'windows/arm/v6',
      71 => 'windows/arm/v7',
      72 => 'windows/arm64',
      73 => 'windows/arm64/v8',
    ),
  ),
  'names' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `names` from the official Snyk API operation. The container registry names',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/container_images';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'image_ids' => 'image_ids',
  'platform' => 'platform',
  'names' => 'names',
  'version' => 'version',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
