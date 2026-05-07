<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Set default model for a feature.
 *
 * Maps to the official LangSmith endpoint PUT /v1/platform/features/{feature}/default-model.
 */
class LangSmithPutV1PlatformFeaturesFeatureDefaultModel extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_v1_platform_features_feature_default_model';
    protected const DESCRIPTION = 'Set default model for a feature

Official endpoint: PUT /v1/platform/features/{feature}/default-model
Sets or replaces the default model for a feature in the workspace.';
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
    protected const PATH = '/v1/platform/features/{feature}/default-model';
    protected const PATH_PARAMS = array (
  0 => 'feature',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
