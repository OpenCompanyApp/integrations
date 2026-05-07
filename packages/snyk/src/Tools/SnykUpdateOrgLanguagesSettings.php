<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update language settings for an organization (Early Access).
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/settings/open_source/languages/{language}.
 */
class SnykUpdateOrgLanguagesSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_languages_settings';
    protected const DESCRIPTION = 'Update language settings for an organization (Early Access)

Official Snyk endpoint: PATCH /orgs/{org_id}/settings/open_source/languages/{language}

Updates one or more language settings for a specific organization. #### Required permissions - `View Organization (org.read)` - `Edit Organization (org.edit)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org for which we want to update the Snyk Languages settings',
  ),
  'language' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `language` from the official Snyk API operation. The language for which settings are being updated',
    'enum' =>
    array (
      0 => 'javascript',
      1 => 'python',
      2 => 'dotnet',
      3 => 'php',
      4 => 'golang',
      5 => 'java',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/settings/open_source/languages/{language}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'language' => 'language',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
