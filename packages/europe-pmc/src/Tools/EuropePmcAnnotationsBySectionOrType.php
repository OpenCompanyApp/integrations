<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve annotations by article section and/or annotation type.
 */
class EuropePmcAnnotationsBySectionOrType extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_annotations_by_section_or_type';
    protected const DESCRIPTION = 'Retrieve Europe PMC annotations that match an article section and/or annotation type.';
    protected const API = 'annotations';
    protected const PATH = 'annotationsBySectionAndOrType';
    protected const DEFAULTS = ['format' => 'JSON'];
    protected const PARAMETERS = [
        'section' => ['type' => 'string', 'required' => false, 'description' => 'Article section filter. At least section or type is required.'],
        'type' => ['type' => 'string', 'required' => false, 'description' => 'Annotation type filter. At least section or type is required.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
    ];

    /**
     * Execute the annotation lookup after enforcing section/type requirements.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        if (($args['section'] ?? '') === '' && ($args['type'] ?? '') === '') {
            return ToolResult::error((new InvalidArgumentException('section or type is required.'))->getMessage());
        }

        return parent::execute($args);
    }
}
