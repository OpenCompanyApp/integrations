<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Service Provider Configuration (SCIM).
 *
 * Maps to the official GitGuardian endpoint GET /v1/scim/v2/ServiceProviderConfig.
 */
class GitGuardianScimServiceProviderConfig extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_service_provider_config';
    protected const DESCRIPTION = 'List the SCIM specification features available on a service provider.

Official GitGuardian endpoint: GET /v1/scim/v2/ServiceProviderConfig.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/scim/v2/ServiceProviderConfig';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
