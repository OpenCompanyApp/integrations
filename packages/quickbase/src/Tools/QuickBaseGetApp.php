<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Get Quickbase app metadata.
 */
class QuickBaseGetApp extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_get_app';
    public const DESCRIPTION = 'Get metadata for a Quickbase app.';
    public const PARAMETERS = [
        'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
    ];

    /**
     * Get app details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getApp($this->requiredString($args, 'appId', 'appId'));
    }
}
