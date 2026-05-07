<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * When using PUT, be sure to include all the key-value pairs required by the recipient's profile.
 */
class CourierProfilesReplace extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_profiles_replace';
}
