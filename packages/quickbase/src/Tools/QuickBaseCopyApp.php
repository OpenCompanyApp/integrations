<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Copy a Quickbase app.
 */
class QuickBaseCopyApp extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_copy_app';
    public const DESCRIPTION = 'Copy an existing Quickbase app.';
    public const PARAMETERS = [
        'appId' => ['type' => 'string', 'required' => true, 'description' => 'The source application ID.'],
        'body' => ['type' => 'object', 'description' => 'Optional copy settings.'],
    ];

    /**
     * Copy an app.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->copyApp($this->requiredString($args, 'appId', 'appId'), $this->arrayArg($args, 'body'));
    }
}
