<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse dataset run item.
 */
class LangfuseCreateDatasetRunItem extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_dataset_run_item';
    protected const DESCRIPTION = 'Create a Langfuse dataset run item. The body object must match the official dataset run item creation schema.';
    protected const SERVICE_METHOD = 'createDatasetRunItem';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse dataset run item creation body.'],
    ];
}
