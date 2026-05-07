<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * List API keys for a ReadMe project subdomain.
 */
class ReadMeListApiKeys extends AbstractReadMeTool
{
    protected const NAME = 'readme_list_api_keys';
    protected const DESCRIPTION = 'List ReadMe API keys for a project subdomain.';
    protected const METHOD = 'listApiKeys';

    public function parameters(): array
    {
        return [
            'subdomain' => ['type' => 'string', 'required' => true, 'description' => 'ReadMe project subdomain.'],
        ] + ReadMeParameters::pagination();
    }
}
