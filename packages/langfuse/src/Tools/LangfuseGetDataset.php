<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse dataset by name.
 */
class LangfuseGetDataset extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_dataset';
    protected const DESCRIPTION = 'Retrieve a Langfuse v2 dataset by name.';
    protected const SERVICE_METHOD = 'getDataset';
    protected const MODE = 'id';
    protected const ID_KEY = 'dataset_name';
    protected const PARAMETERS = [
        'dataset_name' => ['type' => 'string', 'required' => true, 'description' => 'Dataset name.'],
    ];
}
