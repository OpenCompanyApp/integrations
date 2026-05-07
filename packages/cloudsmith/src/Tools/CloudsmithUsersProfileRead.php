<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Provide a brief for the specified user (if any)..
 *
 * Maps to the official Cloudsmith endpoint get /users/profile/{slug}/.
 */
class CloudsmithUsersProfileRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_users_profile_read';
    protected const DESCRIPTION = 'Provide a brief for the specified user (if any).

Official Cloudsmith endpoint: GET /users/profile/{slug}/

Provide a brief for the specified user (if any).';
    protected const PARAMETERS = array (
  'slug' => array (
  'type' => 'string',
  'description' => 'slug parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/users/profile/{slug}/';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
