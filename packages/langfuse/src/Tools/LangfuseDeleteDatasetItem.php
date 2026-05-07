<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Delete a Langfuse dataset item by ID.
 */
class LangfuseDeleteDatasetItem extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_delete_dataset_item';
    protected const DESCRIPTION = 'Delete a Langfuse dataset item by ID.';
    protected const SERVICE_METHOD = 'deleteDatasetItem';
    protected const MODE = 'id';
    protected const ID_KEY = 'dataset_item_id';
    protected const PARAMETERS = [
        'dataset_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Dataset item ID to delete.'],
    ];
}
