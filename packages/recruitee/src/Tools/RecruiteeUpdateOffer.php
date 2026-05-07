<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Update a Recruitee offer.
 */
class RecruiteeUpdateOffer extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_update_offer';
    public const DESCRIPTION = 'Update a Recruitee company offer by ID.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Offer ID.'],
        'offer' => ['type' => 'object', 'required' => true, 'description' => 'Offer fields accepted by Recruitee.'],
    ];

    /**
     * Update an offer.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateOffer(
            $this->requiredInt($args, 'id', 'offer ID'),
            $this->requiredArray($args, 'offer', 'offer')
        );
    }
}
