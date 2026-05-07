<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Create a Loops contact property.
 *
 * Property names must be camelCase and use one of the supported Loops value
 * types.
 */
class LoopsCreateContactProperty extends AbstractLoopsTool
{
    protected const NAME = 'loops_create_contact_property';
    protected const DESCRIPTION = 'Create a Loops contact property using a camelCase name and supported value type.';
    protected const METHOD = 'createContactProperty';
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'The camelCase property name, such as planName.'],
        'type' => ['type' => 'string', 'required' => true, 'enum' => ['string', 'number', 'boolean', 'date'], 'description' => 'The property value type.'],
    ];
}
