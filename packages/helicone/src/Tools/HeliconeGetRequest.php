<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Retrieve one Helicone request by ID.
 */
class HeliconeGetRequest extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_get_request';
    protected const DESCRIPTION = 'Retrieve a single request visible in Helicone by request ID.';
    protected const SERVICE_METHOD = 'getRequest';
    protected const MODE = 'id';
    protected const ID_KEY = 'request_id';
    protected const PARAMETERS = [
        'request_id' => ['type' => 'string', 'required' => true, 'description' => 'Helicone request ID.'],
    ];
}
