<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse model definition by ID.
 */
class LangfuseGetModel extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_model';
    protected const DESCRIPTION = 'Retrieve a Langfuse model definition by ID.';
    protected const SERVICE_METHOD = 'getModel';
    protected const MODE = 'id';
    protected const ID_KEY = 'model_id';
    protected const PARAMETERS = [
        'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Model definition ID.'],
    ];
}
