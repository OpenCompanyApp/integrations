<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Validate Dataset Upload.
 */
class FireworksAiValidateDatasetUpload extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_validate_dataset_upload';
    protected const DESCRIPTION = 'Validate Dataset Upload.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/datasets/{dataset_id}:validateUpload';
    protected const PATH_PARAMS = ['account_id', 'dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
