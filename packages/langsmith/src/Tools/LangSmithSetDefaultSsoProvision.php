<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Set Default Sso Provision.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/set-default-sso-provision.
 */
class LangSmithSetDefaultSsoProvision extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_set_default_sso_provision';
    protected const DESCRIPTION = 'Set Default Sso Provision

Official endpoint: POST /api/v1/orgs/current/set-default-sso-provision
Set the current organization as the default for SSO provisioning in self-hosted environments.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/set-default-sso-provision';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
