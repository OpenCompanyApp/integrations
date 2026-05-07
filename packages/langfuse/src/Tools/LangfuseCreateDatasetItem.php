<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse dataset item.
 */
class LangfuseCreateDatasetItem extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_dataset_item';
    protected const DESCRIPTION = 'Create a Langfuse dataset item. The body object must match the official dataset item creation schema.';
    protected const SERVICE_METHOD = 'createDatasetItem';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse dataset item creation body.'],
    ];
}
