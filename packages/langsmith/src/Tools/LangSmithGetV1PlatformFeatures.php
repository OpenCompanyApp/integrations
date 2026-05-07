<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List feature configurations.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/features.
 */
class LangSmithGetV1PlatformFeatures extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_features';
    protected const DESCRIPTION = 'List feature configurations

Official endpoint: GET /v1/platform/features
Returns a consolidated view of default models and disabled models per feature for the workspace.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/features';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
