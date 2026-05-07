<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a user profile..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://app.vssps.visualstudio.com/_apis/profile/profiles/{id}.
 */
class AzureDevOpsProfileProfilesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_profile_profiles_get';
    protected const DESCRIPTION = 'Gets a user profile.

Official Azure DevOps REST API 7.2 endpoint: GET https://app.vssps.visualstudio.com/_apis/profile/profiles/{id} (spec: profile/7.2/profile.json).';
    protected const PARAMETERS = ['id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the target user profile within the same organization, or \'me\' to get the profile of the current authenticated user.'], 'details' => ['type' => 'boolean', 'required' => false, 'description' => 'Return public profile information such as display name, email address, country, etc. If false, the withAttributes parameter is ignored.'], 'with_attributes' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, gets the attributes (named key-value pairs of arbitrary data) associated with the profile. The partition parameter must also have a value.'], 'partition' => ['type' => 'string', 'required' => false, 'description' => 'The partition (named group) of attributes to return.'], 'core_attributes' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list of core profile attributes to return. Valid values are Email, Avatar, DisplayName, and ContactWithOffers.'], 'force_refresh' => ['type' => 'boolean', 'required' => false, 'description' => 'Not used in this version of the API.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'app.vssps.visualstudio.com';
    protected const PATH = '/_apis/profile/profiles/{id}';
    protected const PATH_PARAMS = ['id' => 'id'];
    protected const QUERY_PARAMS = ['details' => 'details', 'withAttributes' => 'with_attributes', 'partition' => 'partition', 'coreAttributes' => 'core_attributes', 'forceRefresh' => 'force_refresh', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
