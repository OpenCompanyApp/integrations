<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Update a Langfuse prompt version.
 */
class LangfuseUpdatePromptVersion extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_update_prompt_version';
    protected const DESCRIPTION = 'Update a Langfuse v2 prompt version. The body object must match the official prompt version update schema.';
    protected const SERVICE_METHOD = 'updatePromptVersion';
    protected const MODE = 'two_ids_body';
    protected const ID_KEY = 'prompt_name';
    protected const SECOND_ID_KEY = 'version';
    protected const PARAMETERS = [
        'prompt_name' => ['type' => 'string', 'required' => true, 'description' => 'Prompt name.'],
        'version' => ['type' => ['string', 'integer'], 'required' => true, 'description' => 'Prompt version.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official prompt version update body.'],
    ];
}
