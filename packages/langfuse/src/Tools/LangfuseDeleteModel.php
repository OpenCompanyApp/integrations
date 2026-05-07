<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Delete a Langfuse model definition by ID.
 */
class LangfuseDeleteModel extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_delete_model';
    protected const DESCRIPTION = 'Delete a Langfuse model definition by ID.';
    protected const SERVICE_METHOD = 'deleteModel';
    protected const MODE = 'id';
    protected const ID_KEY = 'model_id';
    protected const PARAMETERS = [
        'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Model definition ID to delete.'],
    ];
}
