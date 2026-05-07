<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create or send a Missive draft.
 */
class MissiveCreateDraft extends AbstractMissiveTool
{
    public const NAME = 'missive_create_draft';
    public const DESCRIPTION = 'Create a Missive draft, or send immediately when the body includes send=true.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Draft payload matching the Missive drafts endpoint.'],
    ];

    /**
     * Create a draft.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->createDraft($body);
    }
}
