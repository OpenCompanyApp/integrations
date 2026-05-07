<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Retrieve NVD data-source metadata by sourceIdentifier.
 */
class NvdSourceByIdentifier extends AbstractNvdTool
{
    protected const NAME = 'nvd_source_by_identifier';
    protected const DESCRIPTION = 'Retrieve NVD data-source metadata matching one sourceIdentifier.';
    protected const METHOD = 'sourceByIdentifier';
    protected const REQUIRED = ['source_identifier'];
    protected const PARAMETERS = [
        'source_identifier' => ['type' => 'string', 'required' => true, 'description' => 'NVD source identifier.'],
    ];
}
