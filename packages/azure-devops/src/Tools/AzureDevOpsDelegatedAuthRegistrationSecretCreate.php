<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create Alternative Secret for the ADO OAuth App Registration.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/_apis/delegatedauth/registrationsecret/{registrationId}.
 */
class AzureDevOpsDelegatedAuthRegistrationSecretCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_delegated_auth_registration_secret_create';
    protected const DESCRIPTION = 'Create Alternative Secret for the ADO OAuth App Registration

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/_apis/delegatedauth/registrationsecret/{registrationId} (spec: delegatedAuth/7.2/delegatedAuthorization.json).';
    protected const PARAMETERS = ['registration_id' => ['type' => 'string', 'required' => true, 'description' => 'The registration id of the ADO OAuth App Registration'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/_apis/delegatedauth/registrationsecret/{registrationId}';
    protected const PATH_PARAMS = ['registrationId' => 'registration_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
