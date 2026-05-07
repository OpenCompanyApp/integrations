<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * List OpenAPI definitions configured in ReadMe.
 */
class ReadMeListApiDefinitions extends AbstractReadMeTool
{
    protected const NAME = 'readme_list_api_definitions';
    protected const DESCRIPTION = 'List API definitions configured in ReadMe.';
    protected const METHOD = 'listApiDefinitions';

    public function parameters(): array
    {
        return ReadMeParameters::pagination();
    }
}
