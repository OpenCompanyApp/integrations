<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Disable a model for a feature.
 *
 * Maps to the official LangSmith endpoint PUT /v1/platform/features/{feature}/disabled-models.
 */
class LangSmithPutV1PlatformFeaturesFeatureDisabledModels extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_v1_platform_features_feature_disabled_models';
    protected const DESCRIPTION = 'Disable a model for a feature

Official endpoint: PUT /v1/platform/features/{feature}/disabled-models
Adds a model to the disabled list for a feature in the workspace.';
    protected const PARAMETERS = array (
  'feature' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feature`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/platform/features/{feature}/disabled-models';
    protected const PATH_PARAMS = array (
  0 => 'feature',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
