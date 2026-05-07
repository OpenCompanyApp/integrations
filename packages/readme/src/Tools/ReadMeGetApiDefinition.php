<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Get one ReadMe API definition by ID.
 */
class ReadMeGetApiDefinition extends AbstractReadMeTool
{
    protected const NAME = 'readme_get_api_definition';
    protected const DESCRIPTION = 'Get one ReadMe API definition by ID.';
    protected const METHOD = 'getApiDefinition';

    public function parameters(): array
    {
        return [
            'api_id' => ['type' => 'string', 'required' => true, 'description' => 'ReadMe API definition ID.'],
        ];
    }
}
