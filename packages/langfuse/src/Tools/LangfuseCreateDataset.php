<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse v2 dataset.
 */
class LangfuseCreateDataset extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_dataset';
    protected const DESCRIPTION = 'Create a Langfuse v2 dataset. The body object must match the official dataset creation schema.';
    protected const SERVICE_METHOD = 'createDataset';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse dataset creation body.'],
    ];
}
