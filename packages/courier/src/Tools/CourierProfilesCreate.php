<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.
 */
class CourierProfilesCreate extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_profiles_create';
}
