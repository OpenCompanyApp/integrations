<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Retrieve a single public breach by stable HIBP breach name.
 */
class HaveIBeenPwnedBreachByName extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_breach_by_name';
    protected const DESCRIPTION = 'Retrieve a single public breach by stable HIBP breach Name, such as Adobe.';
    protected const METHOD = 'breachByName';
    protected const REQUIRED = ['name'];
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Stable breach Name value.'],
    ];
}
