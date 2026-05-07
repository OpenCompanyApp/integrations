<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Create a short-link drop in Droplr.
 */
class DroplrCreateDrop extends AbstractDroplrTool
{
    public const NAME = 'droplr_create_drop';
    public const DESCRIPTION = 'Create a Droplr short-link drop.';
    public const PARAMETERS = [
        'link' => ['type' => 'string', 'required' => true, 'description' => 'Long URL to shorten.'],
        'title' => ['type' => 'string', 'description' => 'Optional title for the drop.'],
        'variant' => ['type' => 'string', 'description' => 'Optional display variant.'],
        'extra' => ['type' => 'object', 'description' => 'Additional Droplr-supported fields such as privacy or password.'],
    ];

    /**
     * Create a link drop.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createLinkDrop(
            $this->requiredString($args, 'link', 'link'),
            isset($args['title']) ? (string) $args['title'] : null,
            isset($args['variant']) ? (string) $args['variant'] : null,
            $this->arrayArg($args, 'extra')
        );
    }
}
