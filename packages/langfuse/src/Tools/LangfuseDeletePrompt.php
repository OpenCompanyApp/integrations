<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Delete a Langfuse prompt by name.
 */
class LangfuseDeletePrompt extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_delete_prompt';
    protected const DESCRIPTION = 'Delete a Langfuse v2 prompt by name.';
    protected const SERVICE_METHOD = 'deletePrompt';
    protected const MODE = 'id';
    protected const ID_KEY = 'prompt_name';
    protected const PARAMETERS = [
        'prompt_name' => ['type' => 'string', 'required' => true, 'description' => 'Prompt name to delete.'],
    ];
}
