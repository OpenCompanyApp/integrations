<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Re-enable a disabled model for a feature.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/features/{feature}/disabled-models/{model}.
 */
class LangSmithDeleteV1PlatformFeaturesFeatureDisabledModelsModel extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_features_feature_disabled_models_model';
    protected const DESCRIPTION = 'Re-enable a disabled model for a feature

Official endpoint: DELETE /v1/platform/features/{feature}/disabled-models/{model}
Removes a model from the disabled list for a feature in the workspace.';
    protected const PARAMETERS = array (
  'feature' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feature`.',
  ),
  'model' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/features/{feature}/disabled-models/{model}';
    protected const PATH_PARAMS = array (
  0 => 'feature',
  1 => 'model',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
