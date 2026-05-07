<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * List OpenAPI specs in a GitBook space.
 */
class GitBookListOpenApiSpecs extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_list_openapi_specs';
    protected const DESCRIPTION = 'List OpenAPI specs attached to a GitBook space.';
    protected const METHOD = 'listOpenApiSpecs';

    public function parameters(): array
    {
        return GitBookParameters::space() + GitBookParameters::pagination();
    }
}
