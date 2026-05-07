<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete default model for a feature.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/features/{feature}/default-model.
 */
class LangSmithDeleteV1PlatformFeaturesFeatureDefaultModel extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_features_feature_default_model';
    protected const DESCRIPTION = 'Delete default model for a feature

Official endpoint: DELETE /v1/platform/features/{feature}/default-model
Removes the default model for a feature in the workspace.';
    protected const PARAMETERS = array (
  'feature' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feature`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/features/{feature}/default-model';
    protected const PATH_PARAMS = array (
  0 => 'feature',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
