<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse dataset item by ID.
 */
class LangfuseGetDatasetItem extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_dataset_item';
    protected const DESCRIPTION = 'Retrieve a Langfuse dataset item by ID.';
    protected const SERVICE_METHOD = 'getDatasetItem';
    protected const MODE = 'id';
    protected const ID_KEY = 'dataset_item_id';
    protected const PARAMETERS = [
        'dataset_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Dataset item ID.'],
    ];
}
