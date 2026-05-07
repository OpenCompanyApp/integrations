<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Get a single Recruitee offer by ID.
 */
class RecruiteeGetOffer extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_get_offer';
    public const DESCRIPTION = 'Get details for a specific Recruitee offer.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Offer ID.'],
    ];

    /**
     * Get one offer.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getOffer($this->requiredInt($args, 'id', 'offer ID'));
    }
}
