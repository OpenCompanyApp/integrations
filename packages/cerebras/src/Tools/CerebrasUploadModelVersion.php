<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Upload a Cerebras model version.
 */
class CerebrasUploadModelVersion extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_upload_model_version';
    protected const DESCRIPTION = 'Upload a Cerebras model version.';
    protected const METHOD = 'POST';
    protected const PATH = '/management/v1/orgs/{org_name}/models:upload';
    protected const PATH_PARAMS = ['org_name'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['org_name' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras org_name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.']];
}
