<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Execute a safe relative Drone API POST call. */
class DroneCiApiPost extends AbstractDroneCiTool { protected const NAME = 'drone_ci_api_post'; protected const DESCRIPTION = 'Call a safe relative Drone API POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; protected const REQUIRED = ['path']; protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Drone API path such as /api/user/repos. Full URLs are rejected.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']]; }
