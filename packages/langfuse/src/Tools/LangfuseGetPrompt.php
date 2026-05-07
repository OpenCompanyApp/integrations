<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse prompt by name.
 */
class LangfuseGetPrompt extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_prompt';
    protected const DESCRIPTION = 'Retrieve a Langfuse v2 prompt by name with optional version, label, or cache TTL query parameters.';
    protected const SERVICE_METHOD = 'getPrompt';
    protected const MODE = 'id_query';
    protected const ID_KEY = 'prompt_name';
    protected const QUERY_KEYS = ['version', 'label', 'cacheTtlSeconds'];
    protected const PARAMETERS = [
        'prompt_name' => ['type' => 'string', 'required' => true, 'description' => 'Prompt name.'],
        'version' => ['type' => 'integer', 'description' => 'Prompt version to retrieve.'],
        'label' => ['type' => 'string', 'description' => 'Prompt label to resolve.'],
        'cacheTtlSeconds' => ['type' => 'integer', 'description' => 'Cache TTL hint in seconds.'],
    ];
}
