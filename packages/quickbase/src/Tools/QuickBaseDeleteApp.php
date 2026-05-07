<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Delete a Quickbase app.
 */
class QuickBaseDeleteApp extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_delete_app';
    public const DESCRIPTION = 'Delete a Quickbase app by ID. Some realms require the app name confirmation.';
    public const PARAMETERS = [
        'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
        'name' => ['type' => 'string', 'description' => 'Optional app name confirmation.'],
    ];

    /**
     * Delete an app.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteApp($this->requiredString($args, 'appId', 'appId'), isset($args['name']) ? (string) $args['name'] : null);
    }
}
