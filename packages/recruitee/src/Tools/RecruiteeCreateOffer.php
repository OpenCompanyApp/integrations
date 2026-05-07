<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Create a Recruitee offer.
 */
class RecruiteeCreateOffer extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_create_offer';
    public const DESCRIPTION = 'Create a Recruitee company offer (job or talent pool).';
    public const PARAMETERS = [
        'offer' => ['type' => 'object', 'required' => true, 'description' => 'Offer object accepted by Recruitee.'],
    ];

    /**
     * Create an offer.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createOffer($this->requiredArray($args, 'offer', 'offer'));
    }
}
