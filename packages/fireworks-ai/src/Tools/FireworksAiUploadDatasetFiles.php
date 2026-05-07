<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Upload Dataset Files.
 */
class FireworksAiUploadDatasetFiles extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_upload_dataset_files';
    protected const DESCRIPTION = 'Upload Dataset Files.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/datasets/{dataset_id}:upload';
    protected const PATH_PARAMS = ['account_id', 'dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
